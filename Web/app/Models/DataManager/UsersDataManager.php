<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\models\Repository\Table\UserRepository;
use Nette\Security\User;

class UsersDataManager {

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var User @inject @internal */
	public $user;

	public function __construct(UserRepository $userRepo, User $user) {
		$this->userRepo = $userRepo;
		$this->user = $user;
	}

	public function delete(int $userId) {
		$this->userRepo->softDeleteDate($userId, $this->user->getId());
	}

}