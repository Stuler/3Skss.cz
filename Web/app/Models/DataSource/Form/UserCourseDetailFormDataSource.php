<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\Repository\Table\CourseCompletedRepository;
use App\Models\Repository\Table\CourseCompletitionTypeRepository;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\Types\DB\Tables\TDbCourseCompleted;
use App\Types\DB\Tables\TDbInstructor;
use App\Types\Form\TFormUserCourseDetail;
use Exception;
use Nette\Security\User;

class UserCourseDetailFormDataSource {

	/** @var CourseCompletedRepository */
	private $courseCompletedRepo;

	/** @var CourseRepository */
	private $courseRepo;

	/** @var User */
	private $user;

	/** @var InstructorRepository */
	private $instructorRepo;

	/** @var CourseCompletitionTypeRepository */
	private $courseCompletitionTypeRepo;

	public function __construct(CourseCompletedRepository        $courseCompletedRepo,
	                            User                             $user,
	                            InstructorRepository             $instructorRepo,
	                            CourseRepository                 $courseRepo,
	                            CourseCompletitionTypeRepository $courseCompletitionTypeRepo
	) {
		$this->courseCompletedRepo = $courseCompletedRepo;
		$this->user = $user;
		$this->instructorRepo = $instructorRepo;
		$this->courseRepo = $courseRepo;
		$this->courseCompletitionTypeRepo = $courseCompletitionTypeRepo;
	}

	public function getDefaultCourseDetailForm($qualificationId): TFormUserCourseDetail {
		/** @var TDbCourseCompleted $courseCompleted */
		$courseCompleted = $this->courseCompletedRepo->fetchById($qualificationId);
		$values = new TFormUserCourseDetail();
		$values->id = $courseCompleted->id;
		$courseName = $this->courseRepo->findAll()->where('id', $courseCompleted->course_id)->fetch()->name;
		$values->name = $courseName;
		$values->user_id = $courseCompleted->user_id;
		$values->completition_date = $courseCompleted->completition_date->format('Y-m-d') ?: date('Y-m-d');
		$values->instructor_id = $this->instructorRepo->findById($courseCompleted->instructor_id)->fetchField('user_id');
		$values->course_id = $courseCompleted->course_id;
		$values->course_completition_type_id = $courseCompleted->course_completition_type_id;
		$values->note = $courseCompleted->note;

		return $values;
	}

	public function save(TFormUserCourseDetail $values): int {
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
}

class UserCourseDetailFormException extends Exception {

}