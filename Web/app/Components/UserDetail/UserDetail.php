<?php
declare(strict_types=1);

namespace App\Components\UserDetail;

use App\Components\DialogWindow\DialogWindowFactory;
use App\Models\DataSource\Form\UserCourseDetailFormException;
use App\models\DataSource\Form\UserException;
use App\models\DataSource\Form\UserFormDataSource;
use App\Models\Repository\Table\CourseCompletedRepository;
use App\Models\Repository\Table\CourseCompletitionTypeRepository;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\models\Repository\Table\RankRepository;
use App\models\Repository\Table\SquadRepository;
use App\Models\Repository\Table\SquadTypeRepository;
use App\models\Repository\Table\UserRepository;
use App\Types\Form\TFormUser;
use App\Types\Form\TFormUserQualification;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Security\User;

class UserDetail extends Control {

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var CourseCompletedRepository @inject @internal */
	public $courseCompletedRepo;

	/** @var InstructorRepository @inject @internal */
	public $instructorRepo;

	/** @var RankRepository @inject @internal */
	public $rankRepo;

	/** @var UserFormDataSource @inject @internal */
	public $userFormDS;

	/** @var SquadRepository @inject @internal */
	public $squadRepo;

	/** @var User @inject @internal */
	public $user;

	/** @var CourseCompletitionTypeRepository @inject @internal */
	public $courseCompletitionTypeRepo;

	/** @var CourseRepository @inject @internal */
	public $courseRepo;

	/**
	 * @persistent
	 */
	public $userId;

	/**
	 * @persistent
	 */
	public $courseId;

	/**
	 * @persistent
	 */
	public $qualificationId;

	public function render() {
		$id = (int)$this->userId;
		if ($id) {
			$this->template->currentUser = $this->userRepo->fetchById($id);
			$this->template->coursesCompleted = $this->courseCompletedRepo->fetchCoursesCompleted($id);
		}
		$this->template->instructorCourses = $this->instructorRepo->findAllActive()
			->where('user_id', $id)
			->fetchAll();
		$this->template->isEdit = $id != null;

		$this->template->courses = $this->courseRepo->findAllActive()->fetchAll();

		$this->template->setFile(__DIR__ . "/userDetail.latte");
		$this->template->render();
	}

	/**
	 * User basic info form for general user detail view
	 */
	public function createComponentFormUserBasicInfo(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->setMappedType(TFormUser::class);
		$rank = $this->rankRepo->findAll()->fetchPairs('id', 'name');

		$form->addHidden('id');
		$form->addSelect('rank_id', 'Hodnost', $rank);
		//		$form->addText('date_created', 'Členem od')->setHtmlType('datetime-local');
		$form->addText('discord_id', 'Discord ID');
		$form->addText('steam_id', 'Steam ID');

		$form->addSubmit('send', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormUser $values) {
			try {
				$this->userFormDS->updateBasicInfo($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->redrawControl('basicInfo');
			} catch (UserException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function handleEditBasicInfo() {
		$currentDialog = $this['formUserBasicInfo'];
		$currentDialog->setDefaults(
			$this->userFormDS->getDefaultsUserBasicData((int)$this->userId)
		);
		$this->template->showModal = true;
		$this->template->modalName = 'formBasicInfo';
		$this->redrawControl("modal");
	}

	/**
	 * Quick form to edit user functions
	 * Commander
	 * Personalist
	 * Instructor - zoznam kurzov
	 * SquadLeader - prislusnost k jednotke
	 * Pridat komponentu "user functions"?
	 * vytvorit relacnu tabulku user_functions - bude obsahovat user_id, function_id, poznamku
	 */
	public function createComponentFormUserFunctions() {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$ranks = $this->rankRepo->findAll()->fetchPairs('id', 'name');
		$squads = $this->squadRepo->findAllActive()->where('squad_type_id ?', 1)->fetchPairs('id', 'name');

		$form->addHidden('id');
		$form->addSelect('rank_id', 'Hodnost', $ranks);
		$form->addCheckbox('is_commander', 'Velitelství');
		$form->addCheckbox('is_personalist', 'Personalista');
		$form->addCheckbox('is_instructor', 'Instructor');
		$form->addCheckbox('is_squadleader', 'Velitel jednotky');

		$form->addSubmit('send', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormUser $values) {
			try {
				$this->userFormDS->updateUserFunctions($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->redrawControl('basicInfo');
			} catch (UserException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function handleEditUserFunctions() {
		$currentDialog = $this['formUserFunctions'];
		$currentDialog->setDefaults(
			$this->userFormDS->getDefaultsUserFunctions((int)$this->userId)
		);
		$this->template->showModal = true;
		$this->template->modalName = 'formUserFunctions';
		$this->redrawControl("modal");
	}

	public function createComponentFormUserCombatAssignment(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->setMappedType(TFormUser::class);
		$squad = $this->squadRepo->findAllActive()->where('squad_type_id ? OR id ?', SquadTypeRepository::COMBAT, SquadRepository::IN_TRAINING)->fetchPairs('id', 'name');

		$form->addHidden('id');
		$form->addSelect('squad_id', 'Četa', $squad);
		$form->addInteger('squad_pos', 'Pozice v četě');

		$form->addSubmit('send', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormUser $values) {
			try {
				$this->userFormDS->updateCombatAssignment($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->redrawControl('combatAssignment');
			} catch (UserException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function handleEditCombatAssignment() {
		$currentDialog = $this['formUserCombatAssignment'];
		$currentDialog->setDefaults(
			$this->userFormDS->getDefaultsUserCombatAssignment((int)$this->userId)
		);
		$this->template->showModal = true;
		$this->template->modalName = 'formUserCombatAssignment';
		$this->redrawControl("modal");
	}

//	public function createComponentFormUserAdminAssignment(): Form {
//		$form = new Form();
//		$form->getElementPrototype()->class("ajax");
//		$form->setMappedType(TFormUser::class);
//		$squad = $this->squadRepo->findAllActive()->where('squad_type_id', SquadTypeRepository::COMBAT)->fetchPairs('id', 'name');
//
//		$form->addHidden('id');
//
//		$form->onSuccess[] = function (Form $form, TFormUser $values) {
//			try {
//				$this->userFormDS->updateAdminAssignment($values);
//				$this->flashMessage('Změny byly provedeny.', 'ok');
//				$this->redrawControl('combatAssignment');
//			} catch (UserException $e) {
//				$this->flashMessage($e->getMessage(), 'err');
//			}
//		};
//		return $form;
//	}

	public function createComponentFormUserRating(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->setMappedType(TFormUser::class);
		$form->addHidden('id');
		$form->addInteger('tactical_points', 'Taktické body');
		$form->addInteger('penalty', 'Žlutá karta');
		$form->addSubmit('send', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormUser $values) {
			try {
				$this->userFormDS->updateUserRating($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->redrawControl('userRating');
			} catch (UserException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function handleEditUserRating() {
		$currentDialog = $this['formUserRating'];
		$currentDialog->setDefaults(
			$this->userFormDS->getDefaultsUserRating((int)$this->userId)
		);

		$this->template->showModal = true;
		$this->template->modalName = 'formUserRating';
		$this->redrawControl("modal");
	}

	public function handleEditQualification() {
		$currentDialog = $this['formUserQualification'];
		$currentDialog->setDefaults(
			$this->userFormDS->getDefaultsUserCombatAssignment((int)$this->userId)
		);

		$this->template->showModal = true;
		$this->template->modalName = 'formUserQualification';
		$this->redrawControl("modal");
	}

	public function createComponentFormUserQualification(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');
		$form->addHidden('user_id')->setDefaultValue($this->userId);
		$form->addHidden('course_id')->setDefaultValue($this->courseId);
		$form->addText('name', 'Název kurzu')->setDisabled();

		$form->addText('completition_date')->setHtmlType('date');

		$instructors = $this->instructorRepo->fetchPairsForQualification($this->courseId);
		if (count($instructors) > 1) {
			$form->addRadioList('instructor_id', 'Instruktor', $instructors);
		} else {
			$form->addHidden('instructor_id')->setDefaultValue($this->user->getId());
		}

		$courseStates = $this->courseCompletitionTypeRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('course_completition_type_id', 'Stav', $courseStates);
		$form->addText('note', 'Poznámka');
		$form->addSubmit('send', 'Uložit změny');

		$form->onSuccess[] = function (Form $form, TFormUserQualification $values) {
			try {
				$id = $this->userCourseDetailFormDS->save($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->courseId = null;
				$this->qualificationId = null;
				$this->redirect('edit');
			} catch (UserCourseDetailFormException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function handleCloseModal() {
		$this->redrawControl("modal");
	}

}