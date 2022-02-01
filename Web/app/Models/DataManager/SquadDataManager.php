<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\models\Repository\Table\SquadRepository;
use Nette\Security\User;

class SquadDataManager {

	/** @var SquadRepository @inject @internal */
	public $squadRepo;

	/** @var User @inject @internal */
	public $user;

	public function __construct(SquadRepository $squadRepo, User $user) {
		$this->squadRepo = $squadRepo;
		$this->user = $user;
	}

	public function delete(int $squadId) {
		$this->squadRepo->softDeleteDate($squadId, $this->user->getId());
	}

}