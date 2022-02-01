<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\models\Repository\Table\SquadRepository;
use App\Types\DB\Tables\TDbSquad;
use App\Types\Form\TFormSquad;
use Exception;
use Nette\Security\User;

class SquadFormDataSource {

	/** @var SquadRepository */
	public $squadRepo;

	/** @var \Nette\Security\User */
	public $user;

	public function __construct(SquadRepository $squadRepo, User $user) {
		$this->squadRepo = $squadRepo;
		$this->user = $user;
	}

	public function getDefaultsCreateSquad(?int $centerId): TFormSquad {
		$values = new TFormSquad();
		$values->is_active = 1;
		if ($centerId) {
			$values->center_id = $centerId;
		}

		return $values;
	}

	public function getDefaults(?int $squadId, ?int $squadTypeId, ?int $centerId): TFormSquad {
		/** @var TDbSquad $squad */
		$squad = $this->squadRepo->fetchById($squadId);
		$values = new TFormSquad();

		if ($squad) {
			$values->id = $squad->id;
			$values->name = $squad->name;
			$values->abbreviation = $squad->abbreviation;
			$values->description = $squad->description;
			$values->squad_type_id = $squad->squad_type_id;
			$values->center_id = $squad->center_id;
			$values->detachment_id = $squad->detachment_id;
			$values->is_active = $squad->is_active;
			$values->note = $squad->note;
		} else {
			if ($centerId) {
				$values->center_id = $centerId;
			}
			if ($squadTypeId) {
				$values->squad_type_id = $squadTypeId;
			}

			$values->is_active = 1;
		}
		return $values;
	}

	public function save(TFormSquad $values) {
		$squad = new TDbSquad();

		$squad->id = $values->id;
		$squad->name = $values->name;
		$squad->squad_type_id = $values->squad_type_id;
		$squad->detachment_id = $values->detachment_id ?: null;
		$squad->center_id = $values->center_id;
		$squad->note = $values->note;
		$squad->description = $values->description;
		$squad->abbreviation = $values->abbreviation;
		$squad->is_active = $values->is_active;
		$squad->created_by = $this->user->getId();

		return $this->squadRepo->save($squad);
	}

}

class SquadException extends Exception {

}