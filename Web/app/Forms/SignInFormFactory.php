<?php
declare(strict_types=1);

namespace App\Forms;

use App\Types\Form\TFormSignIn;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;

class SignInFormFactory {

	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;

	public function __construct(FormFactory $factory, User $user) {
		$this->factory = $factory;
		$this->user = $user;
	}

	public function create(callable $onSuccess): Form {
		$form = $this->factory->create();

		$form->addEmail('email', 'Email:')
			->setRequired('Zadejte Váš email.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Zadejte Vaše heslo.');

		$form->addSubmit('send', 'Přihlásit');

		$form->onSuccess[] = function (Form $form, TFormSignIn $values) use ($onSuccess): void {
			try {
				$this->user->login($values->email, $values->password);
			} catch (AuthenticationException $e) {
				$form->addError('Nesprávné přihlasovací údaje!');
				return;
			}
			$onSuccess();
		};
		return $form;
	}

}