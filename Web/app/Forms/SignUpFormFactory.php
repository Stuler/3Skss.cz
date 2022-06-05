<?php
declare(strict_types=1);

namespace App\Forms;

use App\models\DuplicateNameException;
use App\models\UserManager;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Nette\SmartObject;

class SignUpFormFactory {
	use SmartObject;

	private const PASSWORD_MIN_LENGTH = 6;

	/** @var FormFactory */
	private $factory;

	/** @var UserManager */
	private $userManager;

	public function __construct(FormFactory $factory, UserManager $userManager) {
		$this->factory = $factory;
		$this->userManager = $userManager;
	}

	public function create(callable $onSuccess): Form {
		$form = $this->factory->create();
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

		$form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
			try {
				$this->userManager->add($values->id, $values->nick, $values->email, $values->password);
				//				$this->redirect(':Admin:Users:Edit', $values->id);
			} catch (DuplicateNameException $e) {
				$form['username']->addError('Uživatel s tímto nickem už existuje.');
				return;
			}
			$onSuccess();
		};

		return $form;
	}
}