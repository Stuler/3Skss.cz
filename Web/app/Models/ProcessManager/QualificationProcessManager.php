<?php
declare(strict_types=1);

namespace App\Models\ProcessManager;

use App\Models\Process\QualificationProcess;
use App\Types\Form\TFormUserQualification;
use App\Types\Form\TFormUserTrainingStatus;

class QualificationProcessManager {

	/** @var QualificationProcess @inject @internal */
	public $qualificationProcess;

	public function __construct(
		QualificationProcess $qualificationProcess
	) {
		$this->qualificationProcess = $qualificationProcess;
	}

	/**
	 * Saves qualification of given user
	 */
	public function save(TFormUserQualification $values): int {
		return $this->qualificationProcess->save($values);
	}

	/**
	 * Grants instructor rights to super admin when new course is created
	 */
	public function createInstructorSuperAdmin(int $courseId) {
		$this->qualificationProcess->createInstructorSuperAdmin($courseId);
	}

	/**
	 * Creates UNFULFILLED qualification on all courses for new user
	 */
	public function createInitialQualificationNewUser(int $id) {
		$this->qualificationProcess->createInitialQualificationNewUser($id);
	}

	/**
	 * Creates new course UNFULFILLED qualification for all users
	 */
	public function createInitialQualificationNewCourse(int $courseId) {
		$this->qualificationProcess->createQualificationNewCourse($courseId);
	}

	/**
	 * Modifies user's training status
	 */
	public function changeUserTrainingStatus(TFormUserTrainingStatus $values) {
		$this->qualificationProcess->changeUserTrainingStatus($values);
	}
}