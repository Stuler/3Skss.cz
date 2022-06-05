<?php
declare(strict_types=1);

namespace App\MemberModule\Presenters;

use App\Presenters\_core\BasePresenter;

class BaseMemberPresenter extends BasePresenter {

	protected function startup() {
		if (!$this->isLinkCurrent(':Sign:in') && $this->user->isInRole("guest")) {
			$this->flashMessage('Nejsi přihlášený nebo nemáš dostatečná oprávnění.');
			$this->redirect(':Sign:in');
		}
		parent::startup();
	}
}