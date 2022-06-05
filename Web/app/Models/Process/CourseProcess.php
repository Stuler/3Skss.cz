<?php
declare(strict_types=1);

namespace App\Models\Process;

use App\Models\ProcessManager\QualificationProcessManager;
use App\Models\Repository\Table\CourseRepository;
use App\Types\DB\Tables\TDbCourse;
use App\Types\Form\TFormCourse;
use Nette\Security\User;

class CourseProcess {

	/** @var CourseRepository */
	public $courseRepo;

	/** @var User */
	public $user;

	/** @var QualificationProcessManager @inject @internal */
	public $qualificationPM;

	public function __construct(
		CourseRepository            $courseRepo,
		User                        $user,
		QualificationProcessManager $qualificationPM

	) {
		$this->courseRepo = $courseRepo;
		$this->user = $user;
		$this->qualificationPM = $qualificationPM;
	}

	/**
	 * Saves/updates course data
	 */
	public function save(TFormCourse $values): int {
		$course = new TDbCourse();
		$course->id = $values->id;
		$course->name = $values->name;
		$course->abbreviation = $values->abbreviation;
		$course->description = $values->description;
		$course->note = $values->note;
		$course->course_level_id = $values->course_level_id;

		$courseId = $this->courseRepo->save($course);

		// Automatically grants instructor rights to super admin
		$this->qualificationPM->createInstructorSuperAdmin($courseId);

		// Creates UNFULFILLED qualification for all users
		$this->qualificationPM->createInitialQualificationNewCourse($courseId);
		return $courseId;
	}

}