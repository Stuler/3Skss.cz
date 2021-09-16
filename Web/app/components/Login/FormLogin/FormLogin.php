<?php
declare(strict_types=1);

namespace App\components\Login\FormLogin;

use Nette\Application\UI\Control;
use Nette\Forms\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;

class FormLogin extends Control {

	/** @var User */
	protected $user;

	/**
	 * Povolen checkbox na trvalé přihlášení?
	 * @var bool
	 */
	protected $isPermanentLogin = true;

	/** @var array Kam přesměrovat po úspěšném loginu ? */
	public $linkRedirectAfterLogin = "Dashboard:default";

	public function render() {
		$this->template->setFile(__DIR__ . "/formLogin.latte");
		$this->template->render();
	}

	public function createComponentFormLogin(): Form {
		$form = new \Nette\Application\UI\Form();

		$form->addText('nick', 'Přihlašovací e-mail')->addRule(Form::FILLED);

		$form->addPassword('password', 'Heslo')->addRule(Form::FILLED);

		if ($this->isPermanentLogin) {
			$form->addCheckbox("is_permanent", "Přihlásit trvale?")->setDefaultValue(true);
		} else {
			$form->addHidden('is_permanent')->setDefaultValue(false);
		}

		$form->addSubmit("login", "přihlásit se");

		$form->onSuccess[] = [$this, "formLoginSubmitted"];

		return $form;
	}

	/**
	 * @param \Nette\Application\UI\Form $form
	 * @return void
	 */
	public function formLoginSubmitted(Form $form) {
		try {
			$values = $form->getValues(true);
			$this->user->login($values['nick'], $values['password']);
			/** TODO: IMPLEMENTOVAT permanent login
			 * if (array_key_exists('is_permanent', $values) && $values['is_permanent']) {
			 * // nastavení trvalého přihlášení do cookie
			 * $userId = $this->user->getIdentity()->getId();
			 * $this->permanentLogin->setLogin($userId);
			 * }
			 */
			$form->getPresenter()->redirect($this->linkRedirectAfterLogin);
		} catch (AuthenticationException $e) {
			$form->getParent()->flashMessage($e->getMessage(), "err");
		}
	}
}