<?php
declare(strict_types=1);

namespace App\Forms;

use App\models\DuplicateNameException;
use App\models\UserManager;
use Nette\Application\UI\Form;
use Nette\SmartObject;

class SignUpFormFactory {
	use SmartObject;

	private const PASSWORD_MIN_LENGTH = 7;

	/** @var FormFactory */
	private $factory;

	/** @var UserManager */
	private $userPM;

	public function __construct(FormFactory $factory, UserManager $userPM) {
		$this->factory = $factory;
		$this->userPM = $userPM;
	}

	public function create(callable $onSuccess): Form {
		$form = $this->factory->create();
		$form->addText('nick', 'Pick a username:')
			->setRequired('Please pick a username.');

		$form->addEmail('email', 'Your e-mail:')
			->setRequired('Please enter your e-mail.');

		$form->addPassword('password', 'Create a password:')
			->setOption('description', sprintf('at least %d characters', self::PASSWORD_MIN_LENGTH))
			->setRequired('Please create a password.')
			->addRule($form::MIN_LENGTH, null, self::PASSWORD_MIN_LENGTH);

		$form->addSubmit('send', 'Sign up');

		$form->onSuccess[] = function (Form $form, \stdClass $values) use ($onSuccess): void {
			try {
				$this->userPM->add($values->username, $values->email, $values->password);
			} catch (DuplicateNameException $e) {
				$form['username']->addError('Username is already taken.');
				return;
			}
			$onSuccess();
		};

		return $form;
	}
}