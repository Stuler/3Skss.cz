<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Forms\FormFactory;
use Nette\Application\AbortException;
use Nette\Application\UI\Presenter;

/**
 * Hlavná trieda pre AdminPresentery
 * Slúži na presmerovanie neprihlasenych uživatelov a vkladanie info o uzivatelovi do templatu
 */
class BaseAdminPresenter extends Presenter {

	/** @var FormFactory */
	protected $formFactory;

	/**
	 * @param FormFactory $formFactory
	 */
	public function injectFormFactory(FormFactory $formFactory) {
		$this->formFactory = $formFactory;
	}

	protected function startup(): void {
		parent::startup();
		if (!$this->getUser()->isAllowed($this->getName(), $this->getAction())) {
			$this->flashMessage('Pro tuto akci nemáš dostatečná oprávnění.');
			if (!$this->user->isLoggedIn()) {
				$this->redirect('Sign:in');
			} else {
				$this->redirect('Dashboard');
			}
		}
	}

	public function actionLogout() {
		$this->user->logout();
		$this->redirect('login');
	}

	public function beforeRender(): void {
		parent::beforeRender();
		if ($this->user->isLoggedIn()) {
			$this->template->nickname = $this->user->identity->nick;
			$this->template->role = $this->user->identity->role;
		}
	}

}