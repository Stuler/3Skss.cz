<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\Repository\Table\CenterRepository;
use App\Types\DB\Tables\TDbCenter;
use App\Types\Form\TFormCenter;
use Exception;
use Nette\Security\User;

class CenterFormDataSource {

	/** @var CenterRepository */
	public $centerRepo;

	/** @var User */
	public $user;

	public function __construct(CenterRepository $centerRepo,
	                            User             $user
	) {
		$this->centerRepo = $centerRepo;
		$this->user = $user;
	}

	public function save(TFormCenter $values): int {
		$center = new TDbCenter();
		$center->id = $values->id;
		$center->name = $values->name;
		$center->description = $values->description;
		$center->note = $values->note;
		$center->abbreviation = $values->abbreviation;
		$center->is_active = $values->is_active;
		$center->created_by = $this->user->getId();
		return $this->centerRepo->save($center);
	}

}

class CenterException extends Exception {

}