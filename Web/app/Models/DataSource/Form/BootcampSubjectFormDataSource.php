<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\ProcessManager\BootcampProcessManager;
use App\Models\Repository\Table\BootcampClassRepository;
use App\Types\DB\Tables\TDbBootcamp;
use App\Types\Form\TFormBootcamp;
use App\Types\Form\TFormBootcampSubject;
use Nette\Security\User;

class BootcampSubjectFormDataSource {

	/** @var BootcampClassRepository */
	public $bootcampClassRepo;

	/** @var BootcampProcessManager */
	public $bootcampPM;

	/** @var User */
	public $user;

	public function __construct(
		BootcampClassRepository $bootcampClassRepo,
		BootcampProcessManager  $bootcampPM,
		User                    $user
	) {
		$this->bootcampClassRepo = $bootcampClassRepo;
		$this->bootcampPM = $bootcampPM;
		$this->user = $user;
	}

	public function getDefaults(int $bootcampId): TFormBootcamp {
		/** @var TDbBootcamp $bootcamp */
		$bootcamp = $this->bootcampClassRepo->fetchById($bootcampId);

		$values = new TFormBootcamp();

		$values->id = $bootcamp->id;
		return $values;
	}

	public function save(TFormBootcampSubject $values): int {
		return $this->bootcampPM->addSubject($values);
	}
}