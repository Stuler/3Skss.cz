<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Forms\SignInFormFactory;
use App\Forms\SignUpFormFactory;
use App\models\DuplicateNameException;
use App\models\UserManager;
use App\Presenters\_core\BasePresenter;
use App\Types\Form\TFormUser;
use Nette\Application\UI\Form;

class DashboardPresenter extends BasePresenter {

	/** @persistent */
	public $backlink = '';

	/** @var SignInFormFactory */
	private $signInFactory;

	/** @var SignUpFormFactory */
	private $signUpFactory;

	/** @var UserManager @inject @internal */
	public $userManager;

	private const PASSWORD_MIN_LENGTH = 6;

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

	public function createComponentRegistrationForm(): Form {
		$form = new Form();
		$form->addHidden('id');
		$form->addText('nick', 'Nick (ve hře)')
			->setRequired('Prosím, uveď přezívku ve hře.');

		$form->addEmail('email', 'Emailová adresa')
			->setRequired('Prosím, uveď email.');

		$form->addPassword('password', 'Heslo')
			->setOption('description', sprintf('heslo musí mít alespoň %d znaků', self::PASSWORD_MIN_LENGTH))
			->setRequired('Prosím, uveď heslo.')
			->addRule($form::MIN_LENGTH, null, self::PASSWORD_MIN_LENGTH);

		$form->addSubmit('send', 'Registrovat');

		$form->onSuccess[] = function (Form $form, TFormUser $values) {
			try {
				$id = $values->id;
				$nick = $values->nick;
				$email = $values->email;
				$password = $values->password;
				$this->userManager->add($id, $nick, $email, $password);
				//				$this->userId = $values->id;
				$this->redirect('login');
			} catch (DuplicateNameException $e) {
				$form['username']->addError('Uživatel s tímto nickem už existuje.');
				return;
			}
		};
		return $form;
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

}