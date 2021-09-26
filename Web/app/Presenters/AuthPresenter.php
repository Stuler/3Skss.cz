<?php
declare(strict_types=1);

namespace App\Presenters;

use App\components\Login\FormLogin\FormLoginFactory;
use App\Presenters\_core\BasePresenter;

class AuthPresenter extends BasePresenter {

	/** @var FormLoginFactory @inject @internal */
	public $formLoginFactory;

	public function renderLogin() {
		$this->getTemplate()->title = "Prihlášení uživatele";
	}

	public function createComponentFormLogin() {
		return $this->formLoginFactory->create();
	}

	public function actionLogout() {
		$this->user->logout();
		$this->session->destroy();
		$this->redirect('Auth:login');
	}

}