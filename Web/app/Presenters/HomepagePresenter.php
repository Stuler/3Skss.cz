<?php

declare(strict_types=1);

namespace App\Presenters;

use App\components\Login\FormLogin\FormLogin;
use App\components\Login\FormLogin\FormLoginFactory;
use Nette;
use App\models\BaseModel\BaseModel;
use App\models\Repository\Table\UserRepository;

final class HomepagePresenter extends Nette\Application\UI\Presenter {

	/** @var FormLoginFactory @inject @internal */
	public $formLoginFactory;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	public function renderDefault(): void {
		$t = $this->template;
		$t->finds = $this->userRepo->findAllActive();
	}

	public function createComponentFormLogin():FormLogin {
		$formLogin = $this->formLoginFactory->create();
		return $formLogin;
	}
}
