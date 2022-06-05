<?php
declare(strict_types=1);

namespace App\Presenters\_core;

use App\Forms\FormFactory;
use Nette\Application\AbortException;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter {

	/* @var FormFactory Továren na formulare */
	protected $formFactory;

	/**
	 * Získává továreň na formuláře pomocí DI.
	 * @param FormFactory $formFactory
	 */
	public function injectFormFactory(FormFactory $formFactory) {
		$this->formFactory = $formFactory;
	}

//	/**
//	 * Na začátku každé akce u všech presenterů zkontroluje uživatelská oprávnění k této akci.
//	 * @throws AbortException Jestliže uživatel nemá oprávnění k dané akci a bude přesměrován.
//	 */
//	protected function startup() {
//		parent::startup();
//		if (!$this->isLinkCurrent(':Admin:Dashboard:login') && !$this->getUser()->isAllowed($this->getName(), $this->getAction())) {
//			$this->flashMessage('Nejsi přihlášený nebo nemáš dostatečná oprávnění.');
//						$this->redirect(':Admin:Dashboard:login');
//		}
//	}

	public function actionSignOut(): void {
		$this->getUser()->logout(true);
		$this->redirect(':Sign:in');
	}

}