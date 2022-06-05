<?php
declare(strict_types=1);

namespace App\Models\Process;

use App\Models\Repository\Table\BootcampClassRepository;
use App\Models\Repository\Table\BootcampClassRoleRepository;
use App\Models\Repository\Table\BootcampParticipantRepository;
use App\Models\Repository\Table\BootcampSubjectRepository;
use App\Types\DB\Tables\TDbBootcamp;
use App\Types\DB\Tables\TDbBootcampParticipant;
use App\Types\DB\Tables\TDbBootcampSubject;
use App\Types\Form\TFormBootcamp;
use App\Types\Form\TFormBootcampParticipant;
use App\Types\Form\TFormBootcampSubject;
use Nette\Security\User;

class BootcampProcess {

	/** @var BootcampClassRepository */
	public $bootcampClassRepo;

	/** @var \Nette\Security\User */
	public $user;

	/** @var BootcampParticipantRepository */
	public $bootcampParticipantRepo;

	/** @var BootcampSubjectRepository */
	public $bootcampSubjectRepo;

	public function __construct(
		BootcampClassRepository       $bootcampClassRepo,
		BootcampParticipantRepository $bootcampParticipantRepo,
		BootcampSubjectRepository     $bootcampSubjectRepo,
		User                          $user
	) {
		$this->bootcampClassRepo = $bootcampClassRepo;
		$this->bootcampParticipantRepo = $bootcampParticipantRepo;
		$this->bootcampSubjectRepo = $bootcampSubjectRepo;
		$this->user = $user;
	}

	public function deleteBootcampClass(int $id) {
		$this->bootcampClassRepo->softDeleteDate($id, $this->user->getId());
	}

	public function createClass(TFormBootcamp $values): int {
		$bootcamp = new TDbBootcamp();

		// Basic data
		$bootcamp->id = $values->id;
		$bootcamp->label = $values->label;
		$bootcamp->class_number = $values->class_number;
		$bootcamp->active_since = $values->active_since;
		$bootcampId = $this->bootcampClassRepo->save($bootcamp);

		// Subjects
		foreach ($values->subject_id as $subjectId) {
			$subject = new TDbBootcampSubject();
			$subject->course_id = $subjectId;
			$subject->bootcamp_id = $bootcampId;
			$this->bootcampSubjectRepo->save($subject);
		}

		// Main instructor
		$mainInstructor = new TDbBootcampParticipant();
		$mainInstructor->bootcamp_class_id = $bootcampId;
		$mainInstructor->role_id = BootcampClassRoleRepository::MAIN_INSTRUCTOR;
		$mainInstructor->user_id = $values->main_instructor_id;
		$this->bootcampParticipantRepo->save($mainInstructor);

		// Assistant instructors
		foreach ($values->assistant_instructor_id as $assistantInstructorId) {
			$assistantInstructor = new TDbBootcampParticipant();
			$assistantInstructor->bootcamp_class_id = $bootcampId;
			$assistantInstructor->role_id = BootcampClassRoleRepository::ASSISTANT_INSTRUCTOR;
			$assistantInstructor->user_id = $assistantInstructorId;
			$this->bootcampParticipantRepo->save($assistantInstructor);
		}

		// Recruits
		foreach ($values->recruit_id as $recruitId) {
			$recruit = new TDbBootcampParticipant();
			$recruit->bootcamp_class_id = $bootcampId;
			$recruit->role_id = BootcampClassRoleRepository::RECRUIT;
			$recruit->user_id = $recruitId;
			$this->bootcampParticipantRepo->save($recruit);
		}

		return $bootcampId;
	}

	public function addParticipant(TFormBootcampParticipant $values): int {
		$bootcampParticipant = new TDbBootcampParticipant();
		$bootcampParticipant->id = $values->id;
		$bootcampParticipant->bootcamp_class_id = $values->bootcamp_class_id;
		$bootcampParticipant->role_id = $values->role_id;
		$bootcampParticipant->user_id = $values->user_id;
		return $this->bootcampParticipantRepo->save($bootcampParticipant);
	}

	public function deleteParticipant(int $id) {
		$this->bootcampParticipantRepo->softDeleteDate($id, $this->user->getId());
	}

	public function addSubject(TFormBootcampSubject $values): int {
		$bootcampSubject = new TDbBootcampSubject();

		$bootcampSubject->id = $values->id;
		$bootcampSubject->bootcamp_id = $values->bootcamp_id;
		$bootcampSubject->course_id = $values->course_id;

		return $this->bootcampSubjectRepo->save($bootcampSubject);
	}
}