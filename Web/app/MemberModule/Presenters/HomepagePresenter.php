<?php

declare(strict_types=1);

namespace App\MemberModule\Presenters;

use App\components\Login\FormLogin\FormLogin;
use App\components\Login\FormLogin\FormLoginFactory;
use Nette;
use Nette\Database\Explorer;

final class HomepagePresenter extends Nette\Application\UI\Presenter {

	/** @var FormLoginFactory @inject @internal */
	public $formLoginFactory;

	/** @var \Nette\Database\Context */
	private $db;

	public function __construct(Explorer $db) {
		$this->db = $db;
	}

	public function renderDefault(): void {
		$t = $this->template;
	}

	public function createComponentFormLogin():FormLogin {
		$formLogin = $this->formLoginFactory->create();
		return $formLogin;
	}
}
