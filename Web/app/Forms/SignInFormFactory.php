<?php
declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use Nette\SmartObject;

class SignInFormFactory {
	use SmartObject;

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
		$form->addText('nick', 'Nick')
			->setRequired('Prosím, uveď svůj nick.');

		$form->addPassword('password', 'Heslo')
			->setRequired('Prosim, zadej heslo');

		$form->addCheckbox('remember', 'Zapamatovat přihlášení');

		$form->addSubmit('send', 'Přihlásit');

		$form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
			try {
				$this->user->setExpiration($values->remember ? '14 days' : '60 minutes');
				$this->user->login($values->nick, $values->password);
			} catch (AuthenticationException $e) {
				$form->addError('Zadané jméno nebo heslo je nesprávné.');
				return;
			}
			$onSuccess();
		};

		return $form;
	}
}