<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\Courses\CourseLevel\CourseLevelFactory;
use App\Components\Courses\FormBootcamp\FormBootcamp;
use App\Components\Courses\FormBootcamp\FormBootcampFactory;
use App\Components\Courses\FormBootcampParticipant\FormBootcampParticipant;
use App\Components\Courses\FormBootcampParticipant\FormBootcampParticipantFactory;
use App\Models\DataManager\BootcampDataManager;
use App\Models\DataSource\Form\BootcampSubjectFormDataSource;
use App\Models\DataSource\Form\CourseException;
use App\Models\DataSource\Form\CourseFormDataSource;
use App\Models\DataSource\Form\CourseLevelException;
use App\Models\DataSource\Form\CourseLevelFormDataSource;
use App\Models\ProcessManager\BootcampProcessManager;
use App\Models\ProcessManager\QualificationProcessManager;
use App\Models\Repository\Table\BootcampClassRepository;
use App\Models\Repository\Table\BootcampParticipantRepository;
use App\Models\Repository\Table\BootcampSubjectRepository;
use App\Models\Repository\Table\CourseCompletedRepository;
use App\Models\Repository\Table\CourseCompletitionTypeRepository;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\CourseLevelRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\Models\Repository\Table\TrainingStatusRepository;
use App\Presenters\_core\BasePresenter;
use App\Types\Form\TFormBootcampSubject;
use App\Types\Form\TFormCourse;
use App\Types\Form\TFormCourseLevel;
use App\Types\Form\TFormUserQualification;
use App\Types\Form\TFormUserTrainingStatus;
use Nette\Application\UI\Form;

class TrainingCenterPresenter extends BaseAdminPresenter {

	/** @var CourseRepository @inject @internal */
	public $courseRepo;

	/** @var CourseFormDataSource @inject @internal */
	public $courseFormDS;

	/** @var CourseLevelRepository @inject @internal */
	public $courseLevelRepo;

	/** @var CourseLevelFactory @inject @internal */
	public $courseLevelFactory;

	/** @var CourseLevelFormDataSource @inject @internal */
	public $courseLevelDS;

	/** @var FormBootcampFactory @inject @internal */
	public $formBootcampFactory;

	/** @var BootcampClassRepository @inject @internal */
	public $bootcampClassRepo;

	/** @var BootcampProcessManager @inject @internal */
	public $bootcampPM;

	/** @var FormBootcampParticipantFactory @inject @internal */
	public $formBootcampParticipantFactory;

	/** @var BootcampParticipantRepository @inject @internal */
	public $bootcampParticipantRepo;

	/** @var BootcampSubjectFormDataSource @inject @internal */
	public $bootcampSubjectFormDS;

	/** @var BootcampSubjectRepository @inject @internal */
	public $bootcampSubjectRepo;

	/** @var CourseCompletedRepository @inject @internal */
	public $courseCompletedRepo;

	/** @var BootcampDataManager @inject @internal */
	public $bootcampDM;

	/** @var CourseCompletitionTypeRepository @inject @internal */
	public $courseCompletitionTypeRepo;

	/** @var QualificationProcessManager @inject @internal */
	public $qualificationPM;

	/** @var InstructorRepository @inject @internal */
	public $instructorRepo;

	/** @var TrainingStatusRepository @inject @internal */
	public $trainingStatusRepo;

	/**
	 * @persistent
	 */
	public $courseId;

	/**
	 * @persistent
	 */
	public $courseLevelId;

	/**
	 * @persistent
	 */
	public $bootcampId;

	public function renderDefault() {
		$this->template->etapes = $this->courseLevelRepo->findAllActive()->fetchAll();
		$this->template->bootcamps = $this->bootcampClassRepo->findAllActive()->fetchAll();
		$this->template->courses = $this->courseRepo->findAllActive()->fetchAll();
	}

	public function renderEditCourse() {
		$course = $this->courseRepo->fetchById($this->courseId);
		$this['formCourse']->setDefaults($course);
	}

	public function renderEditCourseLevel() {
		$courseLevel = $this->courseLevelRepo->fetchById($this->courseLevelId);
		$this['formCourseLevel']->setDefaults($courseLevel);
	}

	public function renderEditBootcamp(?int $bootcampId) {
		$bootcamp = $this->bootcampClassRepo->fetchById($bootcampId);
		$participants = $this->bootcampParticipantRepo
			->findByBootcampId($bootcampId);

		$mainInstructors = $this->bootcampParticipantRepo
			->findMainInstructors($bootcampId)
			->fetchAll();

		$assistInstructors = $this->bootcampParticipantRepo
			->findAssistInstructors($bootcampId)
			->fetchAll();

		$recruits = $this->bootcampParticipantRepo
			->findRecruits($bootcampId)
			->fetchAll();

		$subjects = $this->bootcampSubjectRepo->fetchByBootcampId($bootcampId);

		$bootcampQualification = $this->courseCompletedRepo->fetchQualificationByBootcampId($bootcampId);

		$this->template->bootcamp = $bootcamp;
		$this->template->participants = $participants;
		$this->template->mainInstructors = $mainInstructors;
		$this->template->assistInstructors = $assistInstructors;
		$this->template->recruits = $recruits;
		$this->template->subjects = $subjects;
		$this->template->bootcampQualification = $bootcampQualification;
	}

	/**
	 * Form for bootcamp creation/editation
	 */
	public function createComponentFormBootcamp(): FormBootcamp {
		$c = $this->formBootcampFactory->create();
		$c->onSaveOpen[] = function ($id) {
			$this->redirect('editBootcamp', ["bootcampId" => $id]);
		};
		$c->onSave[] = function () {
			$this->handleCloseModal();
			$this->redrawControl();
		};
		return $c;
	}

	/**
	 * Opens dialog with bootcamp editatiom form
	 */
	public function handleEditBootcamp(?int $bootcampId) {
		$currentDialog = $this['formBootcamp'];
		if ($bootcampId) {
			$this->bootcampId = $bootcampId;
			$currentDialog->bootcampId = $bootcampId;
			$currentDialog->setDefaultsEditBootcamp($bootcampId);
		}
		$this->template->showModal = true;
		$this->template->modalName = 'formBootcamp';
		$this->redrawControl();
	}

	/**
	 * Deletes bootcamp
	 */
	public function handleDeleteBootcamp(int $id
	) {
		$this->bootcampPM->deleteBootcampClass($id);
	}

	/**
	 * Form for adding new subjects to bootcamp
	 */
	public function createComponentFormBootcampSubject(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');
		$form->addHidden('bootcamp_id');

		$courses = $this->courseRepo->findAllActive()->fetchPairs('id', 'name');
		$form->addSelect('course_id', 'Výcvik', $courses);

		$form->addSubmit('send', 'Přidat výcvik');
		$form->onSuccess[] = function (Form $form, TFormBootcampSubject $values) {
			$this->bootcampSubjectFormDS->save($values);
			$this->flashMessage('Změny byly provedeny.', 'ok');
			$this->redirect('this');
		};
		return $form;
	}

	/**
	 * Shows dialog with subject add form
	 */
	public function handleAddSubject(int $bootcampId
	) {
		$this['formBootcampSubject']->setDefaults(
			['bootcamp_id' => $bootcampId]
		);
		$this->template->showModal = true;
		$this->template->modalName = 'formBootcampSubject';
		$this->redrawControl();
	}

	/**
	 * Form for adding new bootcamp participant
	 */
	public function createComponentFormBootcampParticipant(): FormBootcampParticipant {
		$c = $this->formBootcampParticipantFactory->create();
		$c->onSaveNext[] = function ($roleId) {
			$this->redirect('addParticipant!', ['roleId' => $roleId]);
		};
		$c->onSave[] = function () {
			$this->handleCloseModal();
			$this->redrawControl();
		};
		return $c;
	}

	/**
	 * Shows dialog with participant add form
	 */
	public function handleAddParticipant(int $bootcampId, ?int $roleId = null
	) {
		$this->template->showModal = true;
		$this->template->modalName = 'formBootcampParticipant';
		$this['formBootcampParticipant']->bootcampId = $bootcampId;
		$this['formBootcampParticipant']->setDefaultsAddParticipant($roleId);
		$this->redrawControl();
	}

	/**
	 * Deletes bootcamp participant
	 */
	public function handleDeleteParticipant(int $id) {
		$this->bootcampPM->deleteParticipant($id);
	}

	public function createComponentFormCourseLevel(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');
		$form->addText('name', 'Název etapy');
		$form->addText('abbreviation', 'Zkratka');
		$form->addTextArea('description', 'Popis');
		$form->addText('note', 'Poznámka');
		$form->addSubmit('create', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormCourseLevel $values) {
			try {
				$id = $this->courseLevelDS->save($values);
				$this->redirect('this');
			} catch (CourseLevelException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	/**
	 * User given course qualification editation form
	 */
	public function createComponentFormUserQualificationByCourse(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');
		$form->addHidden('user_id');
		$form->addHidden('course_id');

		$form->addText('user_name', 'Uživatel')->setDisabled();
		$form->addText('course_name', 'Výcvik')->setDisabled();

		$completitionTypes = $this->courseCompletitionTypeRepo
			->findAll()
			->fetchPairs('id', 'name');
		$form->addSelect('course_completition_type_id', 'Kvalifikace', $completitionTypes);

		$instructors = $this->instructorRepo->fetchPairsForQualification($this->courseId);
		$form->addSelect('instructor_id', 'Instruktor', $instructors);

		$form->addSubmit('save', 'Uložit');
		$form->onSuccess[] = function (Form $form, TFormUserQualification $values) {
			$id = $this->qualificationPM->save($values);
			$this->handleCloseModal();
			$this->redrawControl('qualification');
		};
		return $form;
	}

	/**
	 * Shows user qualification editation form
	 */
	public function handleEditQualification(int $userId, int $courseId) {
		/** @var \App\Types\DB\Tables\TDbCourseCompleted $userCourseQualification */
		$userCourseQualification = $this->courseCompletedRepo->fetchUserCourseQualification($userId, $courseId);
		$currentDialog = $this['formUserQualificationByCourse'];
		$currentDialog->setDefaults([
			'id'                          => $userCourseQualification->id,
			'user_name'                   => $userCourseQualification->user->nick,
			'user_id'                     => $userCourseQualification->user_id,
			'course_name'                 => $userCourseQualification->course->name,
			'course_id'                   => $userCourseQualification->course_id,
			'instructor_id'               => $userCourseQualification->instructor->user_id,
			'course_completition_type_id' => $userCourseQualification->course_completition_type_id,
		]);
		$this->template->showModal = true;
		$this->template->modalName = 'formUserQualificationByCourse';
	}

	/**
	 * User training status editation form
	 */
	public function createComponentFormUserTrainingStatus(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");

		$trainingStates = $this->trainingStatusRepo->findAllActive()->fetchPairs('id', 'label');

		$form->addHidden('id');
		$form->addHidden('bootcamp_class_id');
		$form->addHidden('user_id');
		$form->addText('user_name', 'Uživatel')->setDisabled();
		$form->addSelect('training_status_id', 'Status', $trainingStates);
		$form->addText('date_change', 'Datum změny')->setHtmlType('datetime-local');

		$form->addSubmit('save', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormUserTrainingStatus $values) {
			$this->qualificationPM->changeUserTrainingStatus($values);
			$this->handleCloseModal();
			$this->redrawControl('qualification');
		};
		return $form;
	}

	/**
	 * Shows dialog to change user training status
	 */
	public function handleEditTrainingStatus(int $userId) {
		/** @var \App\Types\DB\Tables\TDbBootcampParticipant $userTrainingStatus */
		$userTrainingStatus = $this->bootcampParticipantRepo->fetchTrainingStatusByUserId((int)$this->bootcampId, $userId);
		$currentDialog = $this['formUserTrainingStatus'];
		$currentDialog->setDefaults([
			'id'                 => $userTrainingStatus->id,
			'bootcamp_class_id'  => $this->bootcampId,
			'user_id'            => $userId,
			'user_name'          => $userTrainingStatus->user->nick,
			'training_status_id' => $userTrainingStatus->training_status_id,
		]);
		$this->template->showModal = true;
		$this->template->modalName = 'formUserTrainingStatus';
	}

	/**
	 * Course create/edit form
	 */
	public function createComponentFormCourse(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');
		$form->addText('name', 'Název výcviku');
		$form->addText('abbreviation', 'Zkratka');
		$form->addTextArea('description', 'Popis');
		$form->addText('note', 'Poznámka');

		$courseEtapes = $this->courseLevelRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('course_level_id', 'Povinný pro:', $courseEtapes);

		$form->addSubmit('create', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormCourse $values) {
			try {
				$id = $this->courseFormDS->save($values);
				$this->redirect('this');
			} catch (CourseException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	/**
	 * Shows dialog
	 */
	public function handleShowModal() {
		$this->template->showModal = true;
		$this->redrawControl('modal');
	}

	/**
	 * Closes dialog
	 */
	public function handleCloseModal() {
		$this->redrawControl("modal");
	}
}