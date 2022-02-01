<?php
declare(strict_types=1);

namespace App\models\DataSource\Form;

use App\models\Repository\Table\UserRepository;
use App\Types\DB\Tables\TDbUser;
use App\Types\Form\TFormUser;
use Exception;
use Nette\Utils\DateTime;

class UserFormDataSource {
	/** @var UserRepository */
	private $userRepo;

	public function __construct(UserRepository $userRepo) {
		$this->userRepo = $userRepo;
	}

	public function getDefaultsSelectUser($userId): TFormUser {
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
	 * @throws \App\models\DataSource\Form\UserException
	 */
	public function save(TFormUser $values): int {
		$user = new TDbUser();

		$user->id = $values->id;
		$user->nick = $values->nick;
		$user->password = $values->password;
		$user->email = $values->email;
		$user->discord_id = $values->discord_id;
		$user->steam_id = $values->steam_id;
		$user->login_role_id = $values->login_role_id;
		$user->squad_id = $values->squad_id;
		$user->squad_pos = $values->squad_pos;
		$this->validatePosition($user->squad_id, $user->squad_pos);
		$user->rank_id = $values->rank_id;
		$user->tactical_points = $values->tactical_points;
		$user->penalty = $values->penalty;
		$user->is_active = $values->is_active;
		$user->note = $values->note;

		return $this->userRepo->save($user);
	}

	public function validatePosition($squadId, $squadPosition) {
		/** @var TDbUser $positionTaken */
		$positionTaken = $this->userRepo->findAllActive()->where('squad_id', $squadId)->where('squad_pos', $squadPosition)->limit(1)->fetch();
		if ($positionTaken) {
			bdump($positionTaken->nick);
			throw new UserException('Tato pozice je obsazena hráčem ' . $positionTaken->nick . '.');
		}
	}
}

class UserException extends Exception {

}