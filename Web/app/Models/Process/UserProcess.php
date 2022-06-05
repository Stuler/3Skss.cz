<?php
declare(strict_types=1);

namespace App\Models\Process;

use App\models\DataSource\Form\UserException;
use App\Models\ProcessManager\QualificationProcessManager;
use App\Models\Repository\Table\CourseRepository;
use App\models\Repository\Table\UserRepository;
use App\Types\DB\Tables\TDbUser;
use App\Types\Form\TFormUser;

class UserProcess {

	/** @var UserRepository */
	public $userRepo;

	/** @var CourseRepository */
	public $courseRepo;

	/** @var QualificationProcessManager */
	public $qualificationPM;

	public function __construct(
		UserRepository              $userRepo,
		CourseRepository            $courseRepo,
		QualificationProcessManager $qualificationPM
	) {
		$this->userRepo = $userRepo;
		$this->courseRepo = $courseRepo;
		$this->qualificationPM = $qualificationPM;
	}

	/**
	 * Saves/updates user
	 * @throws \App\models\DataSource\Form\UserException
	 */
	public function save(TFormUser $values): int {
		$user = new TDbUser();

		$user->id = $values->id;
		$user->nick = $values->nick;
		$user->discord_id = $values->discord_id;
		$user->steam_id = $values->steam_id;
		$user->login_role_id = $values->login_role_id;
		$user->squad_id = $values->squad_id;
		$user->squad_pos = $values->squad_pos;
		if ($values->squad_pos) {
			$this->validatePosition($user->squad_id, $user->squad_pos);
		}
		$user->rank_id = $values->rank_id;
		$user->tactical_points = $values->tactical_points;
		$user->penalty = $values->penalty;
		$user->is_active = $values->is_active;
		$user->note = $values->note;

		$id = $this->userRepo->save($user);

		// Creates initial qualification for new user
		if (!$values->id) {
			$this->createInitialQualificationNewUser($id, $values);
		}
		return $id;
	}

	/**
	 * Updates user functions within the unit hierarchy
	 */
	public function updateFunctions(TFormUser $values): int {
		$user = new TDbUser();
		$user->id = $values->id;
		$user->is_commander = $values->is_commander;
		$user->is_personalist = $values->is_personalist;
		$user->is_instructor = $values->is_instructor;
		$user->is_squadleader = $values->is_squadleader;
		$user->rank_id = $values->rank_id;
		return $this->userRepo->save($user);
	}

	/**
	 * Updates user basic info
	 */
	public function updateBasicInfo(TFormUser $values): int {
		$user = new TDbUser();
		$user->id = $values->id;
		$user->rank_id = $values->rank_id;
		$user->discord_id = $values->discord_id;
		$user->steam_id = $values->steam_id;
		return $this->userRepo->save($user);
	}

	/**
	 * Updates user combat assignment
	 * @throws \App\models\DataSource\Form\UserException
	 */
	public function updateCombatAssignment(TFormUser $values): int {
		$user = new TDbUser();
		$user->id = $values->id;
		$this->validatePosition($values->squad_id, $values->squad_pos);
		$user->squad_id = $values->squad_id;
		$user->squad_pos = $values->squad_pos;

		if ($values->squad_pos == 1) {
			$user->is_squadleader = 1;
		} else {
			$user->is_squadleader = 0;
		}
		return $this->userRepo->save($user);
	}

	/**
	 * Updates user rating
	 */
	public function updateRating(TFormUser $values): int {
		$user = new TDbUser();
		$user->id = $values->id;
		$user->tactical_points = $values->tactical_points;
		$user->penalty = $values->penalty;
		return $this->userRepo->save($user);
	}

	/**
	 * Checks assigned position in squad occupancy
	 * @throws \App\models\DataSource\Form\UserException
	 */
	public function validatePosition($squadId, $squadPosition) {
		/** @var TDbUser $positionTaken */
		$positionTaken = $this->userRepo->findAllActive()->where('squad_id', $squadId)->where('squad_pos', $squadPosition)->limit(1)->fetch();
		if ($positionTaken) {
			throw new UserException('Tato pozice je obsazena hráčem ' . $positionTaken->nick . '.');
		}
	}

	/**
	 * Sets all courses completition type to UNFULFILLED by the given user
	 */
	private function createInitialQualificationNewUser(int $id) {
		$this->qualificationPM->createInitialQualificationNewUser($id);
	}

	/**
	 * User lazy deletion
	 */
	public function deleteUser(int $id) {
		$this->userRepo->softDeleteDate($id, $this->user->getId());
	}
}