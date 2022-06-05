<?php
declare(strict_types=1);

namespace App\Models\ProcessManager;

use App\Models\Process\BootcampProcess;
use App\Types\Form\TFormBootcamp;
use App\Types\Form\TFormBootcampParticipant;
use App\Types\Form\TFormBootcampSubject;

class BootcampProcessManager {

	/** @var BootcampProcess */
	public $bootcampProcess;

	public function __construct(BootcampProcess $bootcampProcess) {
		$this->bootcampProcess = $bootcampProcess;
	}

	/**
	 * Creates bootcamp class
	 */
	public function createClass(TFormBootcamp $values): int {
		return $this->bootcampProcess->createClass($values);
	}

	/**
	 * Deletes bootcamp class
	 */
	public function deleteBootcampClass(int $id) {
		$this->bootcampProcess->deleteBootcampClass($id);
	}

	/**
	 * Adds bootcamp participant
	 */
	public function addParticipant(TFormBootcampParticipant $values): int {
		return $this->bootcampProcess->addParticipant($values);
	}

	/**
	 * Deletes bootcamp participant
	 */
	public function deleteParticipant(int $id) {
		$this->bootcampProcess->deleteParticipant($id);
	}

	/**
	 * Adds bootcamp subject
	 */
	public function addSubject(TFormBootcampSubject $values): int {
		return $this->bootcampProcess->addSubject($values);
	}
}