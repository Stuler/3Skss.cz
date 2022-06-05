<?php
declare(strict_types=1);

namespace App\Models\ProcessManager;

use App\Models\Process\UserProcess;
use App\Types\Form\TFormUser;

class UserProcessManager {

	/** @var UserProcess */
	public $userProcess;

	public function __construct(
		UserProcess $userProcess
	) {
		$this->userProcess = $userProcess;
	}

	/**
	 * Calls user saving process
	 * @throws \App\models\DataSource\Form\UserException
	 */
	public function save(TFormUser $values): int {
		return $this->userProcess->save($values);
	}

	/**
	 * Calls process to update user`s basic info
	 */
	public function updateBasicInfo(TFormUser $values) {
		$this->userProcess->updateBasicInfo($values);
	}

	/**
	 * Calls process to update user`s combat assignment
	 * @throws \App\models\DataSource\Form\UserException
	 */
	public function updateCombatAssignment(TFormUser $values) {
		$this->userProcess->updateCombatAssignment($values);
	}

	/**
	 * Calls process to save user rating
	 */
	public function updateUserRating(TFormUser $values) {
		$this->userProcess->updateRating($values);
	}

	/**
	 * Deletes user
	 */
	public function deleteUser(int $userId) {
		$this->userProcess->deleteUser($userId);
	}

	/**
	 * Updates user functions within the unit hierarchy
	 */
	public function updateUserFunctions(TFormUser $values) {
		$this->userProcess->updateFunctions($values);
	}
}