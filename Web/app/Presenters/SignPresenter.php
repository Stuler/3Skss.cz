<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Forms\SignInFormFactory;
use App\Presenters\_core\BasePresenter;
use Nette\Application\UI\Form;

class SignPresenter extends BasePresenter {

	/** @var SignInFormFactory @inject @internal */
	public $signInFormFactory;

	/**
	 * Sign-in form factory.
	 */
	protected function createComponentSignInForm(): Form {
		return $this->signInFormFactory->create(function (): void {
			$this->flashMessage('Přihlášení proběhlo úspěšně.');
			if ($this->user->isInRole("admin")) {
				$this->redirect(':Admin:Dashboard:default');
			} else {
				$this->redirect(':Member:Dashboard:default');
			}
		});
	}


	public function actionSignOut(): void {
		$this->getUser()->logout(true);
		$this->redirect(':Admin:Sign:in');
	}
}