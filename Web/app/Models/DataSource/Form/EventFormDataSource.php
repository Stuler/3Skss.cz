<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\Repository\Table\EventRepository;
use App\models\UserManager;
use App\Types\DB\Tables\TDbEvent;
use App\Types\Form\TFormEvent;
use Exception;
use Nette\Security\User;

class EventFormDataSource {

	/** @var EventRepository */
	private $eventRepo;

	/** @var User */
	private $user;

	public function __construct(EventRepository $eventRepo, User $user) {
		$this->eventRepo = $eventRepo;
		$this->user = $user;
	}

	public function setDefaultsSelectEvent(int $id): TFormEvent {
		/** @var TDbEvent $event */
		$event = $this->eventRepo->fetchById($id);

		$values = new TFormEvent();
		$values->id = $event->id;
		$values->name = $event->name;
		$values->event_type_id = $event->event_type_id;
		$values->date_from = $event->date_from->format('Y-m-d\\TH:i:s');
		$values->date_to = $event->date_to->format('Y-m-d\\TH:i:s');
		$values->description = $event->description;
		$values->slots_count = $event->slots_count;
		$values->created_by = $event->created_by;
		$values->zeus = $event->zeus;

		return $values;
	}

	public function save(TFormEvent $values): int {
		$event = new TDbEvent();
		$event->id = $values->id;
		$event->event_type_id = $values->event_type_id;
		$event->name = $values->name;
		$event->date_from = $values->date_from;
		$event->date_to = $values->date_to;
		$event->description = $values->description;
		$event->slots_count = $values->slots_count;
		$event->created_by = $this->user->getId();
		if ($values->zeus) {
			$event->zeus = $values->zeus;
		} else {
			$event->zeus = $this->user->getId();
		}

		return $this->eventRepo->save($event);
	}

}

class EventException extends Exception {

}