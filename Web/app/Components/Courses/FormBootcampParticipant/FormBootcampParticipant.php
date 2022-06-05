<?php
declare(strict_types=1);

namespace App\Components\Courses\FormBootcampParticipant;

use App\Models\DataSource\Form\FormBootcampParticipantDataSource;
use App\Models\Repository\Table\BootcampClassRoleRepository;
use App\models\Repository\Table\UserRepository;
use App\Types\Form\TFormBootcampParticipant;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class FormBootcampParticipant extends Control {

	public $onSave;
	public $onSaveNext;

	public $bootcampId;

	/** @var FormBootcampParticipantDataSource @inject @internal */
	public $formBootcampParticipantDS;

	/** @var BootcampClassRoleRepository @inject @internal */
	public $bootcampClassRoleRepo;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	public function render() {

		$this->template->setFile(__DIR__ . "/formBootcampParticipant.latte");
		$this->template->render();
	}

	public function setDefaultsAddParticipant(?int $roleId = null) {
		if ($roleId != null) {
			$this['formBootcampParticipant']->setDefaults(
				$this->formBootcampParticipantDS->getDefaultsAdd($this->bootcampId, $roleId)
			);
		} else {
			$this['formBootcampParticipant']->setDefaults(
				$this->formBootcampParticipantDS->getDefaultsAdd($this->bootcampId)
			);
		}
	}

	public function createComponentFormBootcampParticipant(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->setMappedType(TFormBootcampParticipant::class);

		$roles = $this->bootcampClassRoleRepo->findAllActive()->fetchPairs('id', 'label');
		$users = $this->userRepo->findAllActive()->fetchPairs('id', 'nick');

		$form->addHidden('id');
		$form->addHidden('bootcamp_class_id');
		$form->addSelect('role_id', 'Funkce', $roles)->setRequired('Vyberte roli');
		$form->addSelect('user_id', 'Člen', $users)->setRequired('Vyberte uživatele')->setPrompt('?');

		$form->addSubmit('save', 'Uložit');
		$form->addSubmit('saveNext', 'Uložit a přidat dalšího');

		$form->onSuccess[] = function (Form $form, TFormBootcampParticipant $values) {
			$id = $this->formBootcampParticipantDS->save($values);
			$this->flashMessage('Účastník byl úspěšně přidán.', 'ok');
			if ($form['saveNext']->isSubmittedBy()) {
				$this->onSaveNext($values->role_id);
			} else {
				$this->onSave();
			}
		};
		return $form;
	}
}