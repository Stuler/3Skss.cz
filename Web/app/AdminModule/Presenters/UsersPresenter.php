<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\Courses\UserCourseDetail\UserCourseDetail;
use App\Components\Courses\UserCourseDetail\UserCourseDetailFactory;
use App\Components\CustomList\CustomList;
use App\Components\CustomList\CustomListFactory;
use App\Components\UserDetail\UserDetail;
use App\Components\UserDetail\UserDetailFactory;
use App\Models\DataManager\UsersDataManager;
use App\Models\DataSource\Form\UserCourseDetailFormDataSource;
use App\Models\DataSource\Form\UserCourseDetailFormException;
use App\models\DataSource\Form\UserException;
use App\models\DataSource\Form\UserFormDataSource;
use App\models\DuplicateNameException;
use App\Models\Repository\Table\CourseCompletedRepository;
use App\Models\Repository\Table\CourseCompletitionTypeRepository;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\models\Repository\Table\RankRepository;
use App\models\Repository\Table\LoginRoleRepository;
use App\models\Repository\Table\SquadRepository;
use App\Models\Repository\Table\SquadTypeRepository;
use App\models\Repository\Table\UserRepository;
use App\models\UserManager;
use App\Presenters\_core\BasePresenter;
use App\Presenters\_core\SecuredPresenter;
use App\Types\Form\TFormUser;
use App\Types\Form\TFormUserCourseDetail;
use Nette\Application\UI\Form;

class UsersPresenter extends BasePresenter {

	/*
	 * TODO:
	 * do tabulky user pridat last_login_date - current_timestamp- current timestamp
	 * nick, password, email - varchar max 100
	 * odstranit Admina z prveho miesta! vhodit fiktivneho uzivatela bez prav
	 * pripravit migracie DB pre testy aj pre produkciu!!!
	 */

	/** @var UserRepository */
	private $userRepo;

	/** @var SquadRepository */
	private $squadRepo;

	/** @var RankRepository */
	private $rankRepo;

	/** @var UserFormDataSource */
	private $userFormDS;

	/** @var LoginRoleRepository */
	private $roleRepo;

	/** @var CustomListFactory @inject @internal */
	public $customListFactory;

	/** @var CourseRepository @inject @internal */
	public $courseRepo;

	/** @var UserCourseDetailFactory @inject @internal */
	public $userCourseDetailFactory;

	/** @var CourseCompletedRepository @inject @internal */
	public $courseCompletedRepo;

	/** @var CourseCompletitionTypeRepository @inject @internal */
	public $courseCompletitionTypeRepo;

	/** @var InstructorRepository @inject @internal */
	public $instructorRepo;

	/** @var UserCourseDetailFormDataSource @inject @internal */
	public $userCourseDetailFormDS;

	/** @var UserDetailFactory @inject @internal */
	public $userDetailFactory;

	/** @var UserManager @inject @internal */
	public $userManager;

	/** @var UsersDataManager @inject @internal */
	public $usersDM;

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

	public function __construct(UserRepository      $userRepo,
	                            SquadRepository     $squadRepo,
	                            RankRepository      $rankRepo,
	                            UserFormDataSource  $userFormDS,
	                            LoginRoleRepository $roleRepo
	) {
		$this->userRepo = $userRepo;
		$this->squadRepo = $squadRepo;
		$this->rankRepo = $rankRepo;
		$this->userFormDS = $userFormDS;
		$this->roleRepo = $roleRepo;
	}

	public function renderDefault() {
		$this->template->members = $this->userRepo->findAllActive()->fetchAll();
	}

	public function renderView(?int $userId = null) {
		$coursesCompleted = $this->courseCompletedRepo->findCoursesCompleted($userId);
		$this->template->coursesCompleted = $coursesCompleted;
		$this->template->userId = $this->userId;
		$userValues = $this->userRepo->fetchById($userId);
		if ($userId) {
			$this['userDetail']->userId = $userId;
		}
	}

	public function renderEdit(?int $userId = null) {
		$coursesCompleted = $this->courseCompletedRepo->findCoursesCompleted($userId);
		$this->template->coursesCompleted = $coursesCompleted;
		$this->template->userId = $this->userId;
		$userValues = $this->userRepo->fetchById($userId);
		if ($userId) {
			$this['userDetail']->userId = $userId;
			$this['formUser']->setDefaults($this->userFormDS->getDefaultsSelectUser($userId));
		}
	}

	public function renderEditQualification() {
		$coursesCompleted = $this->courseCompletedRepo->findCoursesCompleted($this->userId)->fetchPairs('id', 'course_id');
		$courses = $this->courseRepo->findAll()->fetchAll();
		$this->template->courses = $courses;
		$this->template->showModal = true;
	}

	public function createComponentUserDetail(?string $id): UserDetail {
		return $this->userDetailFactory->create();
	}

	/**
	 * Základní formulář pro úpravu člena
	 */
	public function createComponentFormUser(): Form {
		$form = new Form();

		$form->addHidden('id');
		$form->addText('nick', 'Nick')->setRequired();
		$form->addEmail('email', 'Email');
		$form->addPassword('password', 'Heslo');
		$form->addText('date_created', 'Členem od')->setHtmlType('datetime-local');
		$form->addText('discord_id', 'Discord ID');
		$form->addText('steam_id', 'Steam ID');

		$roles = $this->roleRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('login_role_id', 'Oprávnění', $roles)
			->checkDefaultValue(false);

		$rank = $this->rankRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('rank_id', 'Hodnost', $rank);

		$squad = $this->squadRepo->findAllActive()->where('squad_type_id', SquadTypeRepository::COMBAT)->fetchPairs('id', 'name');
		$form->addSelect('squad_id', 'Četa', $squad)->setPrompt('?');
		$form->addInteger('squad_pos', 'Pozice v četě');

		$form->addInteger('tactical_points', 'Taktické body');
		$form->addInteger('penalty', 'Žlutá karta');
		$form->addCheckbox('is_active', 'Aktivní');

		$form->addTextArea('note', 'Poznámka');

		$form->addSubmit('send', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormUser $values) {
			try {
				$id = $this->userFormDS->save($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->redirect('users:edit', $id);
			} catch (UserException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
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
			$form->addHidden('instructor_id')->setDefaultValue($this->getUser()->getId());
		}

		$courseStates = $this->courseCompletitionTypeRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('course_completition_type_id', 'Stav', $courseStates);
		$form->addText('note', 'Poznámka');
		$form->addSubmit('send', 'Uložit změny');

		$form->onSuccess[] = function (Form $form, TFormUserCourseDetail $values) {
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

	public function actionEditUser(int $userId) {
		$userValues = $this->userRepo->fetchById($userId);
		$this['formUser']->setDefaults($userValues);
	}

	public function handleEditUserQualification(int $courseId, ?int $qualificationId = null) {
		if ($qualificationId) {
			//			$values = $this->userCourseDetailFormDS->getDefaultCourseDetailForm($qualificationId);
			$this['formUserQualification']->setDefaults($this->userCourseDetailFormDS->getDefaultCourseDetailForm($qualificationId));
		} else {
			$course = $this->courseRepo->fetchById($courseId);
			$this['formUserQualification']->setDefaults(['name' => $course['name'], 'completition_date' => date('Y-m-d')]);
		}
		$this->template->showModal = true;
		$this->redrawControl('modalQualification');
	}

	public function handleCloseModal() {
		$this->redrawControl("modal");
	}

	public function actionDelete(int $id) {
		$this->usersDM->delete($id);
		$this->redirect('default');
	}
}