<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\Repository\Table\DetachmentRepository;
use App\Types\DB\Tables\TDbDetachment;
use App\Types\Form\TFormDetachment;
use Nette\Security\User;

class DetachmentFormDataSource {

	/** @var DetachmentRepository */
	public $detachmentRepo;

	/** @var User */
	public $user;

	public function __construct(DetachmentRepository $detachmentRepo,
	                            User                 $user
	) {
		$this->detachmentRepo = $detachmentRepo;
		$this->user = $user;
	}

	public function getDefaultsCreateDetachment(?int $centerId): TFormDetachment {
		$values = new TFormDetachment();
		$values->is_active = 1;
		if ($centerId) {
			$values->center_id = $centerId;
		}
		return $values;
	}

	public function getDefaultsEditDetachment(?int $detachmentId): TFormDetachment {
		/** @var TDbDetachment $detachment */
		$detachment = $this->detachmentRepo->fetchById($detachmentId);
		$values = new TFormDetachment();

		if ($detachment) {
			$values->id = $detachment->id;
			$values->name = $detachment->name;
			$values->abbreviation = $detachment->abbreviation;
			$values->description = $detachment->description;
			$values->center_id = $detachment->center_id;
			$values->parent_detachment_id = $detachment->parent_detachment_id;
			$values->is_active = $detachment->is_active;
			$values->note = $detachment->note;
		} else {
			$values->is_active = 1;
		}
		return $values;
	}

	public function save(TFormDetachment $values): int {
		$detachment = new TDbDetachment();
		$detachment->id = $values->id;
		$detachment->center_id = $values->center_id;
		$detachment->name = $values->name;
		$detachment->description = $values->description;
		$detachment->note = $values->note;
		$detachment->abbreviation = $values->abbreviation;
		$detachment->is_active = $values->is_active;
		$detachment->created_by = $this->user->getId();

		return $this->detachmentRepo->save($detachment);
	}

}