<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\Courses\UserQualification\UserQualificationFactory;
use App\Components\CustomList\CustomListFactory;
use App\Components\UserDetail\UserDetail;
use App\Components\UserDetail\UserDetailFactory;
use App\Forms\SignUpFormFactory;
use App\Models\DataManager\UsersDataManager;
use App\Models\DataSource\Form\UserQualificationFormDataSource;
use App\Models\DataSource\Form\UserCourseDetailFormException;
use App\models\DataSource\Form\UserException;
use App\models\DataSource\Form\UserFormDataSource;
use App\Models\ProcessManager\UserProcessManager;
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
use App\Types\Form\TFormUser;
use App\Types\Form\TFormUserQualification;
use Nette\Application\UI\Form;

class UsersPresenter extends BaseAdminPresenter {

	/*
	 * TODO:
	 * pripravit migracie DB pre testy aj pre produkciu!!!
	 * pre editaciu clena pridat moznost editovat funkciu
	 * upravit editaciu kvalifikacie v detaile
	 * v "Upravit" u kazdeho clena budu suromne veci - nastavenie emailu, nicku a hesla - premenovat na "Upravit soukromé data"
	 * hodnosti - pridat oznacenie NATO, revidovat hodnosti, v orbat zoradit uzivatelov v teamoch podla hodnosti
	 * v orbat kancelariach zobrazovat ludi podla funkcii
	 * pridat logovanie funkcii, hodnosti, kurzov
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

	/** @var UserQualificationFactory @inject @internal */
	public $userCourseDetailFactory;

	/** @var CourseCompletedRepository @inject @internal */
	public $courseCompletedRepo;

	/** @var CourseCompletitionTypeRepository @inject @internal */
	public $courseCompletitionTypeRepo;

	/** @var InstructorRepository @inject @internal */
	public $instructorRepo;

	/** @var UserQualificationFormDataSource @inject @internal */
	public $userCourseDetailFormDS;

	/** @var UserDetailFactory @inject @internal */
	public $userDetailFactory;

	/** @var UserManager @inject @internal */
	public $userManager;

	/** @var UsersDataManager @inject @internal */
	public $usersDM;

	/** @var SignUpFormFactory @inject @internal */
	public $signUpFormFactory;

	/** @var UserProcessManager */
	public $userPM;

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
	                            LoginRoleRepository $roleRepo,
	                            UserProcessManager  $userPM

	) {
		parent::__construct();
		$this->userRepo = $userRepo;
		$this->squadRepo = $squadRepo;
		$this->rankRepo = $rankRepo;
		$this->userFormDS = $userFormDS;
		$this->roleRepo = $roleRepo;
		$this->userPM = $userPM;
	}

	public function renderDefault() {
		$activeMembers = $this->userRepo->findAllActive()->where('is_active ?', 1)->order('rank_id DESC')->fetchAll();
		$inactiveMembers = $this->userRepo->findAllActive()->where('is_active ?', 0)->order('rank_id DESC')->fetchAll();

		$this->template->activeMembers = $activeMembers;
		$this->template->inactiveMembers = $inactiveMembers;
	}

	public function renderView(?int $userId = null) {
		$coursesCompleted = $this->courseCompletedRepo->fetchCoursesCompleted($userId);
		$this->template->coursesCompleted = $coursesCompleted;
		$this->template->userId = $this->userId;
		$userValues = $this->userRepo->fetchById($userId);
		if ($userId) {
			$this['userDetail']->userId = $userId;
		}
	}

	public function renderEdit(?int $userId = null) {
		$coursesCompleted = $this->courseCompletedRepo->fetchCoursesCompleted($userId);
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

	/**
	 * Sign-up form component for new user registration by admin.
	 */
	protected function createComponentSignUpForm(): Form {
		return $this->signUpFormFactory->create(function (): void {
			$this->flashMessage('Uživatel byl úspěšně vytvořen.');
			$this->redirect('Users:');
		});
	}

	/**
	 * Shows user sign up form dialog
	 */
	public function handleCreateUser() {
		$this->template->showModal = true;
		$this->template->modalName = 'SignUpForm';
		$this->redrawControl('modal');
	}

	/**
	 * User detail component - for members module view!! Delete when member module is done
	 */
	public function createComponentUserDetail(): UserDetail {
		return $this->userDetailFactory->create();
	}

	/**
	 * User creation/editation form
	 */
	public function createComponentFormUser(): Form {
		$form = new Form();

		$form->addHidden('id');
		$form->addText('nick', 'Nick')->setRequired();
		$form->addText('date_created', 'Členem od')->setHtmlType('datetime-local');
		$form->addText('discord_id', 'Discord ID');
		$form->addText('steam_id', 'Steam ID');

		$roles = $this->roleRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('login_role_id', 'Oprávnění', $roles)
			->setDefaultValue(2);

		$rank = $this->rankRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('rank_id', 'Hodnost', $rank);

		$squad = $this->squadRepo->findAllActive()->where('squad_type_id ? OR id ?', SquadTypeRepository::COMBAT, SquadRepository::IN_TRAINING)->fetchPairs('id', 'name');
		$form->addSelect('squad_id', 'Četa', $squad)->setPrompt('?');
		$form->addInteger('squad_pos', 'Pozice v četě');

		$form->addInteger('tactical_points', 'Taktické body');
		$form->addInteger('penalty', 'Žlutá karta');
		$form->addCheckbox('is_active', 'Aktivní')->setDefaultValue(1);

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

	/**
	 * Edits user qualification
	 * TODO: delete user from instructor table after removing his instructor status
	 */
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

	/**
	 * Sets user edit form default values
	 */
	public function actionEditUser(int $userId) {
		$userValues = $this->userRepo->fetchById($userId);
		$this['formUser']->setDefaults($userValues);
	}

	/**
	 * Show user qualification editation form modal window with loaded default values
	 */
	public function handleEditUserQualification(int $courseId, ?int $qualificationId = null) {
		if ($qualificationId) {
			//			$values = $this->userCourseDetailFormDS->getDefaultCourseDetailForm($qualificationId);
			$this['formUserQualification']->setDefaults(
				$this->userCourseDetailFormDS->getDefaultCourseDetailForm($qualificationId));
		} else {
			$course = $this->courseRepo->fetchById($courseId);
			$this['formUserQualification']->setDefaults(
				['name'              => $course['name'],
				 'completition_date' => date('Y-m-d')]);
		}
		$this->template->showModal = true;
		$this->redrawControl('modalQualification');
	}

	/**
	 * Closes dialog window
	 */
	public function handleCloseModal() {
		$this->redrawControl("modal");
	}

	/**
	 * Deletes user
	 */
	public function actionDelete(int $id) {
		$this->userPM->deleteUser($id);
		$this->userId = null;
		$this->redirect('default');
	}
}