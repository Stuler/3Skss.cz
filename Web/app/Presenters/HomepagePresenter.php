<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\models\BaseModel\BaseModel;
use App\models\Repository\Table\UserRepository;



final class HomepagePresenter extends Nette\Application\UI\Presenter
{

	/** @var UserRepository @inject @internal */
	public $userRepo;

	public function renderDefault(): void
	{
		$t = $this->template;
		$t->users = $this->userRepo->findAllActive();
	}
}
