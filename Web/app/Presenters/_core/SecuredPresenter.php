<?php
declare(strict_types=1);

namespace App\Presenters\_core;

use Nette\Security\Authenticator;

class SecuredPresenter extends BasePresenter {

	/** @var Authenticator @inject @internal */
	public $authenticator;

	public function startup() {
		parent::startup();

		if (!$this->user->isLoggedIn()) {
			$identity = false;
			//			$this->redirect('Dashboard:default');
		}
	}
}