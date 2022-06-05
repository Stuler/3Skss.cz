<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\ProcessManager\BootcampProcessManager;
use App\Types\Form\TFormBootcampParticipant;
use Nette\Security\User;

class FormBootcampParticipantDataSource {

	/** @var BootcampProcessManager */
	public $bootcampPM;

	/** @var User */
	public $user;

	public function __construct(
		BootcampProcessManager $bootcampPM,
		User                   $user
	) {
		$this->bootcampPM = $bootcampPM;
		$this->user = $user;
	}

	public function getDefaultsAdd($bootcampId, ?int $roleId = null): TFormBootcampParticipant {
		$values = new TFormBootcampParticipant();
		$values->bootcamp_class_id = $bootcampId;
		$values->role_id = $roleId;
		return $values;
	}

	public function save(TFormBootcampParticipant $values): int {
		return $this->bootcampPM->addParticipant($values);
	}

}