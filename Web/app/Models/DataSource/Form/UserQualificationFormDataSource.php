<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\ProcessManager\QualificationProcessManager;
use App\Models\Repository\Table\CourseCompletedRepository;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\Types\DB\Tables\TDbCourseCompleted;
use App\Types\Form\TFormUserQualification;
use Exception;

class UserQualificationFormDataSource {

	/** @var CourseCompletedRepository */
	private $courseCompletedRepo;

	/** @var CourseRepository */
	private $courseRepo;

	/** @var QualificationProcessManager */
	public $qualificationPM;

	/** @var InstructorRepository @inject @internal */
	public $instructorRepo;

	public function __construct(
		CourseCompletedRepository   $courseCompletedRepo,
		CourseRepository            $courseRepo,
		QualificationProcessManager $qualificationPM,
		InstructorRepository        $instructorRepo
	) {
		$this->courseCompletedRepo = $courseCompletedRepo;
		$this->courseRepo = $courseRepo;
		$this->qualificationPM = $qualificationPM;
		$this->instructorRepo = $instructorRepo;
	}

	/**
	 * Returns default values for user qualification form
	 */
	public function getDefaultCourseDetailForm($qualificationId): TFormUserQualification {
		/** @var TDbCourseCompleted $courseCompleted */
		$courseCompleted = $this->courseCompletedRepo->fetchById($qualificationId);
		$values = new TFormUserQualification();
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

	/**
	 * Calls user qualification save/update process
	 */
	public function save(TFormUserQualification $values): int {
		return $this->qualificationPM->save($values);
	}
}

class UserCourseDetailFormException extends Exception {

}