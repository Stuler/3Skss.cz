<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

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

	/** @var UserRepository */
	private $userRepo;

	/** @var InstructorRepository */
	private $instructorRepo;

	/** @var User @inject @internal */
	public $user;

	public function __construct(CourseRepository     $courseRepo,
	                            UserRepository       $userRepo,
	                            InstructorRepository $instructorRepo,
	                            User                 $user
	) {
		$this->courseRepo = $courseRepo;
		$this->userRepo = $userRepo;
		$this->instructorRepo = $instructorRepo;
		$this->user = $user;
	}

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

	public function save(TFormCourse $values) {
		$course = new TDbCourse();
		$course->id = $values->id;
		$course->name = $values->name;
		$course->abbreviation = $values->abbreviation;
		$course->description = $values->description;
		$course->note = $values->note;
		$course->course_level_id = $values->course_level_id;
		$courseId = $this->courseRepo->save($course);

		//Automaticky vytvori instruktora kurzu zo superadmina
		$newInstructor = new TDbInstructor();
		$userAdmin = $this->userRepo->findAllActive()->select('id')->where("is_super_admin", 1)->limit(1)->fetch();
		$newInstructor->user_id = $userAdmin;
		$newInstructor->course_id = $courseId;
		$newInstructor->created_by = $this->user->getId();
		$this->instructorRepo->saveAsInstructor($newInstructor);
	}
}

class CourseException extends Exception {

}