<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\ProcessManager\BootcampProcessManager;
use App\Models\Repository\Table\BootcampClassRepository;
use App\Models\Repository\Table\BootcampParticipantRepository;
use App\Models\Repository\Table\BootcampSubjectRepository;
use App\Types\DB\Tables\TDbBootcamp;
use App\Types\Form\TFormBootcamp;
use Nette\Security\User;

class FormBootcampDataSource {

	/** @var BootcampClassRepository */
	public $bootcampClassRepo;

	/** @var BootcampProcessManager */
	public $bootcampPM;

	/** @var BootcampParticipantRepository */
	public $bootcampParticipantRepo;

	/** @var BootcampSubjectRepository */
	public $bootcampSubjectRepo;

	/** @var User */
	public $user;

	public function __construct(
		BootcampClassRepository       $bootcampClassRepo,
		BootcampProcessManager        $bootcampPM,
		User                          $user,
		BootcampParticipantRepository $bootcampParticipantRepo,
		BootcampSubjectRepository     $bootcampSubjectRepo
	) {
		$this->bootcampClassRepo = $bootcampClassRepo;
		$this->bootcampPM = $bootcampPM;
		$this->user = $user;
		$this->bootcampParticipantRepo = $bootcampParticipantRepo;
		$this->bootcampSubjectRepo = $bootcampSubjectRepo;
	}

	public function getDefaults(int $bootcampId): TFormBootcamp {
		/** @var TDbBootcamp $bootcamp */
		$bootcamp = $this->bootcampClassRepo->fetchById($bootcampId);

		$subjectsArray = [];
		$assistInstructorsArray = [];
		$recruitsArray = [];

		$subjects = $this->bootcampSubjectRepo->fetchByBootcampId($bootcampId)
			->select('id,course_id')
			->fetchAll();

		/** @var \App\Types\DB\Tables\TDbBootcampParticipant $mainInstructors */
		$mainInstructors = $this->bootcampParticipantRepo->findMainInstructors($bootcampId)
			->select('id, user_id')
			->limit(1)
			->fetch();

		$assistInstructors = $this->bootcampParticipantRepo->findAssistInstructors($bootcampId)
			->select('id, user_id')
			->fetchAll();

		$recruits = $this->bootcampParticipantRepo->findRecruits($bootcampId)
			->select('id, user_id')
			->fetchAll();

		$values = new TFormBootcamp();

		$values->id = $bootcamp->id;
		$values->class_number = $bootcamp->class_number;
		$values->label = $bootcamp->label;
		$values->active_since = $bootcamp->active_since->format('Y-m-d');

		$values->main_instructor_id = $mainInstructors->user_id;

		/** @var \App\Types\DB\Tables\TDbBootcampSubject $subject */
		foreach ($subjects as $subject) {
			$subjectsArray[] = $subject->course_id;
		}

		/** @var \App\Types\DB\Tables\TDbBootcampParticipant $assistInstructor */
		foreach ($assistInstructors as $assistInstructor) {
			$assistInstructorsArray[] = $assistInstructor->user_id;
		}

		/** @var \App\Types\DB\Tables\TDbBootcampParticipant $recruit */
		foreach ($recruits as $recruit) {
			$recruitsArray[] = $recruit->user_id;
		}

		$values->subject_id = $subjectsArray;
		$values->assistant_instructor_id = $assistInstructorsArray;
		$values->recruit_id = $recruitsArray;

		return $values;
	}

	public function save(TFormBootcamp $values): int {
		return $this->bootcampPM->createClass($values);
	}

}