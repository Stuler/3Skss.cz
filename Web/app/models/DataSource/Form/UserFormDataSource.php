<?php
declare(strict_types=1);

namespace App\models\DataSource\Form;

use App\Models\ProcessManager\UserProcessManager;
use App\models\Repository\Table\UserRepository;
use App\Types\DB\Tables\TDbUser;
use App\Types\Form\TFormUser;
use Exception;

class UserFormDataSource {
	/** @var UserRepository */
	private $userRepo;

	/** @var UserProcessManager */
	public $userPM;

	public function __construct(
		UserRepository     $userRepo,
		UserProcessManager $userPM
	) {
		$this->userRepo = $userRepo;
		$this->userPM = $userPM;
	}

	/**
	 * Returns data for user administration form
	 */
	public function getDefaultsSelectUser(int $userId): TFormUser {
		/** @var TDbUser $user */
		$user = $this->userRepo->fetchById($userId);

		$values = new TFormUser();
		$values->id = $user->id;
		$values->nick = $user->nick;
		$values->email = $user->email ?: 'test@test.cz';
		$values->date_created = $user->date_created->format('Y-m-d\\TH:i:s');
		$values->discord_id = $user->discord_id;
		$values->steam_id = $user->steam_id;
		$values->login_role_id = $user->login_role_id;
		$values->squad_id = $user->squad_id;
		$values->squad_pos = $user->squad_pos;
		$values->rank_id = $user->rank_id;
		$values->tactical_points = $user->tactical_points;
		$values->penalty = $user->penalty;
		$values->is_active = $user->is_active;
		$values->note = $user->note;
		return $values;
	}

	/**
	 * Returns data for user basic info form
	 */
	public function getDefaultsUserBasicData(int $userId): TFormUser {
		/** @var TDbUser $user */
		$user = $this->userRepo->fetchById($userId);
		$values = new TFormUser();
		$values->id = $user->id;
		$values->nick = $user->nick;
		$values->date_created = $user->date_created->format('Y-m-d\\TH:i:s');
		$values->rank_id = $user->rank_id;
		$values->discord_id = $user->discord_id;
		$values->steam_id = $user->steam_id;
		return $values;
	}

	/**
	 * Returns data for user combat assignment form
	 */
	public function getDefaultsUserCombatAssignment(int $userId): TFormUser {
		/** @var TDbUser $user */
		$user = $this->userRepo->fetchById($userId);
		$values = new TFormUser();
		$values->id = $user->id;
		$values->squad_id = $user->squad_id;
		$values->squad_pos = $user->squad_pos;
		return $values;
	}

	/**
	 * Returns data for user rating form
	 */
	public function getDefaultsUserRating(int $userId): TFormUser {
		/** @var TDbUser $user */
		$user = $this->userRepo->fetchById($userId);
		$values = new TFormUser();
		$values->id = $user->id;
		$values->tactical_points = $user->tactical_points;
		$values->penalty = $user->penalty;
		return $values;
	}

	/**
	 * Returns data for user functions form
	 */
	public function getDefaultsUserFunctions(int $userId): TFormUser {
		/** @var TDbUser $user */
		$user = $this->userRepo->fetchById($userId);
		$values = new TFormUser();
		$values->id = $user->id;
		$values->is_commander = $user->is_commander;
		$values->is_personalist = $user->is_personalist;
		$values->is_instructor = $user->is_instructor;
		$values->is_squadleader = $user->is_squadleader;
		$values->rank_id = $user->rank_id;
		return $values;
	}

	/**
	 * Creates/updates user
	 * @throws \App\models\DataSource\Form\UserException
	 */
	public function save(TFormUser $values): int {
		return $this->userPM->save($values);
	}

	/**
	 * Updates user data from user basic info form
	 */
	public function updateBasicInfo(TFormUser $values) {
		$this->userPM->updateBasicInfo($values);
	}

	/**
	 * Updates user data from user combat assignment form
	 */
	public function updateCombatAssignment(TFormUser $values) {
		$this->userPM->updateCombatAssignment($values);
	}

	/**
	 * Updates user data from user rating form
	 */
	public function updateUserRating(TFormUser $values) {
		$this->userPM->updateUserRating($values);
	}

	/**
	 * Updates user functions within the unit hierarchy
	 */
	public function updateUserFunctions(TFormUser $values) {
		$this->userPM->updateUserFunctions($values);
	}

}

class UserException extends Exception {

}