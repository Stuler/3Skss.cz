<?php
declare(strict_types=1);

namespace App\Models\Process;

use App\Models\Repository\Table\BootcampParticipantRepository;
use App\Models\Repository\Table\CourseCompletedRepository;
use App\Models\Repository\Table\CourseCompletitionTypeRepository;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\Models\Repository\Table\TrainingStatusRepository;
use App\models\Repository\Table\UserRepository;
use App\Types\DB\Tables\TDbBootcampParticipant;
use App\Types\DB\Tables\TDbCourseCompleted;
use App\Types\DB\Tables\TDbInstructor;
use App\Types\Form\TFormUserQualification;
use App\Types\Form\TFormUserTrainingStatus;
use Nette\Security\User;

class QualificationProcess {

	/** @var CourseCompletedRepository */
	public $courseCompletedRepo;

	/** @var InstructorRepository */
	public $instructorRepo;

	/** @var CourseCompletitionTypeRepository */
	public $courseCompletitionTypeRepo;

	/** @var CourseRepository */
	public $courseRepo;

	/** @var UserRepository */
	public $userRepo;

	/** @var BootcampParticipantRepository */
	public $bootcampParticipantRepo;

	/** @var User */
	public $user;

	public function __construct(
		CourseCompletedRepository        $courseCompletedRepo,
		InstructorRepository             $instructorRepo,
		CourseCompletitionTypeRepository $courseCompletitionTypeRepo,
		CourseRepository                 $courseRepo,
		UserRepository                   $userRepo,
		User                             $user,
		BootcampParticipantRepository    $bootcampParticipantRepo
	) {
		$this->courseCompletedRepo = $courseCompletedRepo;
		$this->instructorRepo = $instructorRepo;
		$this->courseCompletitionTypeRepo = $courseCompletitionTypeRepo;
		$this->courseRepo = $courseRepo;
		$this->userRepo = $userRepo;
		$this->user = $user;
		$this->bootcampParticipantRepo = $bootcampParticipantRepo;
	}

	/**
	 * Saves/updates user qualification
	 */
	public function save(TFormUserQualification $values): int {
		$courseCompleted = new TDbCourseCompleted();
		$courseCompleted->id = $values->id;
		$courseCompleted->user_id = $values->user_id;
		$courseCompleted->course_id = $values->course_id;
		$courseCompleted->completition_date = $values->completition_date ?? new \DateTime('now');

		if ($values->instructor_id) {
			$instructor = $this->instructorRepo->findInstructorByUserId($values->instructor_id, $values->course_id)->select('id')->fetch();
			$courseCompleted->instructor_id = $instructor;
		} elseif ($this->user->isInRole('Admin')) {
			$courseCompleted->instructor_id = $this->user->getId();
		} else {
			$courseCompleted->instructor_id = $this->user->getId();
		}

		$courseCompleted->course_completition_type_id = $values->course_completition_type_id;

		if ($courseCompleted->course_completition_type_id == $this->courseCompletitionTypeRepo::INSTRUCTOR) {
			$newInstructor = new TDbInstructor();
			$newInstructor->user_id = $values->user_id;
			$newInstructor->course_id = $values->course_id;
			$newInstructor->note = $values->note;
			$newInstructor->created_by = $this->user->getId();
			$this->instructorRepo->saveAsInstructor($newInstructor);
		}
		$courseCompleted->note = $values->note;
		return $this->courseCompletedRepo->save($courseCompleted);
	}

	/**
	 * Grants instructor rights to super admin when new course is created
	 */
	public function createInstructorSuperAdmin(int $courseId) {
		$newInstructor = new TDbInstructor();
		$userAdmin = $this->userRepo->findSuperAdmin()->select('id')->fetch();
		$newInstructor->user_id = $userAdmin['id'];
		$newInstructor->course_id = $courseId;
		$newInstructor->created_by = $this->user->getId();
		$this->instructorRepo->saveAsInstructor($newInstructor);
	}

	/**
	 * Creates empty qualification for new user
	 */
	public function createInitialQualificationNewUser(int $userId) {
		/** @var \App\Types\DB\Tables\TDbCourse $courses */
		$courses = $this->courseRepo->findAllActive()->select('id')->fetchAll();
		$superAdmin = $this->userRepo->findSuperAdmin()->select('id')->fetch();
		$superAdminInstructorId = $this->instructorRepo->fetchInstructorByUserId($superAdmin['id'])['id'];
		$emptyQualification = new TDbCourseCompleted();
		foreach ($courses as $course) {
			$emptyQualification->user_id = $userId;
			$emptyQualification->course_id = $course;
			$emptyQualification->completition_date = new \DateTime('now');
			$emptyQualification->course_completition_type_id = CourseCompletitionTypeRepository::UNFULFILLED;
			$emptyQualification->instructor_id = $superAdminInstructorId;
			$this->courseCompletedRepo->save($emptyQualification);
		}
	}

	/**
	 * Adds qualification type UNFULFILLED for all users when new course is created
	 */
	public function createQualificationNewCourse(int $courseId) {
		/** @var \App\Types\DB\Tables\TDbUser $users */
		$users = $this->userRepo->findAll()->select('id')->where('is_super_admin ?', false)->fetchAll();
		$superAdmin = $this->userRepo->findSuperAdmin()->select('id')->fetch();
		$superAdminInstructorId = $this->instructorRepo->fetchInstructorByUserId($superAdmin['id'])['id'];
		$emptyQualification = new TDbCourseCompleted();
		foreach ($users as $user) {
			$emptyQualification->user_id = $user->id;
			$emptyQualification->course_id = $courseId;
			$emptyQualification->completition_date = new \DateTime('now');
			$emptyQualification->course_completition_type_id = CourseCompletitionTypeRepository::UNFULFILLED;
			$emptyQualification->instructor_id = $superAdminInstructorId;
			$this->courseCompletedRepo->save($emptyQualification);
		}
	}

	/**
	 * Modifies user's training status
	 */
	public function changeUserTrainingStatus(TFormUserTrainingStatus $values) {
		$userTrainingStatus = new TDbBootcampParticipant();
		$userTrainingStatus->id = $values->id;
		$userTrainingStatus->bootcamp_class_id = $values->bootcamp_class_id;
		$userTrainingStatus->user_id = $values->user_id;
		$userTrainingStatus->training_status_id = $values->training_status_id;

		$customDate = $values->date_change ?? new \DateTime('now');
		if ($values->training_status_id == TrainingStatusRepository::NOT_READY) {
			$userTrainingStatus->date_not_ready = $customDate;
		} elseif ($values->training_status_id == TrainingStatusRepository::READY) {
			$userTrainingStatus->date_ready = $customDate;
		} elseif ($values->training_status_id == TrainingStatusRepository::MANDATORY) {
			$userTrainingStatus->date_mandatory = $customDate;
		} else {
			$userTrainingStatus->date_discarded = $customDate;
		}
		$this->bootcampParticipantRepo->save($userTrainingStatus);
	}

}