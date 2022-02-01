<?php
declare(strict_types=1);

namespace App\Models\DataManager;

use App\Models\Repository\Table\EventRepository;
use Nette\Security\User;

class EventsDataManager {
	/** @var EventRepository @inject @internal */
	public $eventRepo;

	/** @var User @inject @internal */
	public $user;

	public function __construct(EventRepository $eventRepo, User $user) {
		$this->eventRepo = $eventRepo;
		$this->user = $user;
	}

	public function delete(int $eventId) {
		$this->eventRepo->softDeleteDate($eventId, $this->user->getId());
	}
}