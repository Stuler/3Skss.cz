<?php
declare(strict_types=1);

namespace App\models\DataSource\Form;

use App\models\Repository\Table\UserRepository;
use App\Types\DB\Tables\TDbUser;
use App\Types\Form\TFormUser;
use Exception;

class UserFormDataSource {
	/** @var UserRepository */
	private $userRepo;

	public function __construct(UserRepository $userRepo) {
		$this->userRepo = $userRepo;
	}

	public function save(TFormUser $values): int {
		$user = new TDbUser();

		$user->id = $values->id;
		$user->nick = $values->nick;
		$user->role = $values->role;
		$user->note = $values->note;
		$user->squad_id = $values->squad_id;
		$user->squad_pos = $values->squad_pos;
		$user->rank_id = $values->rank_id;
		$user->tactical_points = $values->tactical_points;
		$user->penalty = $values->penalty;
		$user->is_active = $values->is_active;
		$user->note = $values->note;

		return $this->userRepo->save($user);
	}
}

class UserException extends Exception {

}