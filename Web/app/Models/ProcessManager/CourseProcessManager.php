<?php
declare(strict_types=1);

namespace App\Models\ProcessManager;

use App\Models\Process\CourseProcess;
use App\Types\Form\TFormCourse;

class CourseProcessManager {

	/** @var CourseProcess @inject @internal */
	public $courseProcess;

	public function __construct(
		CourseProcess $courseProcess
	) {
		$this->courseProcess = $courseProcess;
	}

	/**
	 * Saves/updates course data
	 */
	public function save(TFormCourse $values): int {
		return $this->courseProcess->save($values);
	}

}