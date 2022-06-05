<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\Models\Repository\Table\BootcampParticipantRepository;
use App\Models\Repository\Table\BootcampSubjectRepository;
use App\Models\Repository\Table\CourseCompletedRepository;

class BootcampDataManager {

	/** @var CourseCompletedRepository */
	public $courseCompletedRepo;

	/** @var BootcampParticipantRepository */
	public $bootcampParticipantRepo;

	/** @var BootcampSubjectRepository */
	public $bootcampSubjectRepo;

	public function __construct(
		CourseCompletedRepository     $courseCompletedRepo,
		BootcampParticipantRepository $bootcampParticipantRepo,
		BootcampSubjectRepository     $bootcampSubjectRepo
	) {
		$this->courseCompletedRepo = $courseCompletedRepo;
		$this->bootcampSubjectRepo = $bootcampSubjectRepo;
		$this->bootcampParticipantRepo = $bootcampParticipantRepo;
	}

	/**
	 * OBSOLETE
	 * Returns qualification of all bootcamp recruits for all bootcamp subjects
	 */
	public function getBootcampQualification(int $bootcampId): array {

		$users = $this->bootcampParticipantRepo
			->findRecruits($bootcampId)
			->fetchAll();

		$subjects = $this->bootcampSubjectRepo
			->fetchByBootcampId($bootcampId)
			->fetchAll();

		return $this->courseCompletedRepo->fetchQualificationByBootcampId($bootcampId);
	}
}