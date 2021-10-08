<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Forms\SignInFormFactory;
use App\Forms\SignUpFormFactory;
use App\Presenters\_core\BasePresenter;
use Nette\Application\UI\Form;

class DashboardPresenter extends BasePresenter {

	/** @persistent */
	public $backlink = '';

	/** @var SignInFormFactory */
	private $signInFactory;

	/** @var SignUpFormFactory */
	private $signUpFactory;

	/**
	 * @param SignInFormFactory $signInFactory
	 * @param SignUpFormFactory $signUpFactory
	 */
	public function __construct(SignInFormFactory $signInFactory, SignUpFormFactory $signUpFactory) {
		parent::__construct();
		$this->signInFactory = $signInFactory;
		$this->signUpFactory = $signUpFactory;
	}

	public function renderDefault() {
		if ($this->getUser()->isLoggedIn())
			$this->template->username = $this->user->identity->username;
	}

	/**
	 * Sign-in form factory.
	 */
	protected function createComponentSignInForm(): Form {
		return $this->signInFactory->create(function (): void {
			$this->flashMessage('Přihlášení proběhlo úspěšně.');
			$this->redirect('Dashboard:default');
		});
	}

	/**
	 * Sign-up form factory.
	 */
	protected function createComponentSignUpForm(): Form {
		return $this->signUpFactory->create(function (): void {
			$this->flashMessage('Uživatel byl úspěšně zaregistrován.');
			$this->redirect('Dashboard:');
		});
	}

	public function actionLogin() {
		if ($this->getUser()->isLoggedIn())
			$this->redirect('Dashboard:');
	}

	public function actionLogout(): void {
		$this->getUser()->logout(true);
		$this->redirect('login');
	}

}