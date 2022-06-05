<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\ProcessManager\CourseProcessManager;
use App\Models\ProcessManager\QualificationProcessManager;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\models\Repository\Table\UserRepository;
use App\Types\DB\Tables\TDbCourse;
use App\Types\DB\Tables\TDbInstructor;
use App\Types\Form\TFormCourse;
use Exception;
use Nette\Security\User;

class CourseFormDataSource {
	/** @var CourseRepository */
	private $courseRepo;

	/** @var User */
	public $user;

	/** @var QualificationProcessManager */
	public $qualificationPM;

	/** @var CourseProcessManager @inject @internal */
	public $coursePM;

	public function __construct(CourseRepository            $courseRepo,
	                            UserRepository              $userRepo,
	                            InstructorRepository        $instructorRepo,
	                            User                        $user,
	                            QualificationProcessManager $qualificationPM,
	                            CourseProcessManager        $coursePM
	) {
		$this->courseRepo = $courseRepo;
		$this->user = $user;
		$this->qualificationPM = $qualificationPM;
		$this->coursePM = $coursePM;
	}

	/**
	 * Returns default values for course edit/create form
	 */
	public function getDefaultsSelectCourse($familyId): TFormCourse {
		/** @var TDbCourse $course */
		$course = $this->courseRepo->fetchById($familyId);

		$values = new TFormCourse();
		$values->id = $course->id;
		$values->name = $course->name;
		$values->abbreviation = $course->abbreviation;
		$values->description = $course->description;
		$values->note = $course->note;
		$values->course_level_id = $course->course_level_id;
		return $values;
	}

	/**
	 * Calls processes to save/update course data
	 */
	public function save(TFormCourse $values): int {
		return $this->coursePM->save($values);
	}
}

class CourseException extends Exception {

}