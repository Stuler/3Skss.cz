<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\Models\Repository\Table\DetachmentRepository;
use Nette\Security\User;

class DetachmentDataManager {

	/** @var DetachmentRepository @inject @internal */
	public $detachmentRepo;

	/** @var User @inject @internal */
	public $user;

	public function __construct(DetachmentRepository $detachmentRepo, User $user) {
		$this->detachmentRepo = $detachmentRepo;
		$this->user = $user;
	}

	public function delete(int $detachmentId) {
		$this->detachmentRepo->softDeleteDate($detachmentId, $this->user->getId());
	}

}