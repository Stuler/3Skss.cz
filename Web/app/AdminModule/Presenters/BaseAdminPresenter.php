<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Presenters\_core\BasePresenter;
use Nette\Application\UI\Presenter;

class BaseAdminPresenter extends BasePresenter {

	protected function startup() {
		if (!$this->isLinkCurrent(':Sign:in') && !$this->user->isInRole("admin")) {
			$this->flashMessage('Nejsi přihlášený nebo nemáš dostatečná oprávnění.');
			$this->redirect(':Sign:in');
		}
		parent::startup();
	}

}