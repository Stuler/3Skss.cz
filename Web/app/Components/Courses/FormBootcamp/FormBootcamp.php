<?php
declare(strict_types=1);

namespace App\Components\Courses\FormBootcamp;

use App\Models\DataSource\Form\FormBootcampDataSource;
use App\Models\DataSource\Form\FormBootcampParticipantDataSource;
use App\Models\ProcessManager\BootcampProcessManager;
use App\Models\Repository\Table\BootcampClassRoleRepository;
use App\Models\Repository\Table\CourseRepository;
use App\models\Repository\Table\UserRepository;
use App\Types\Form\TFormBootcamp;
use App\Types\Form\TFormBootcampParticipant;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class FormBootcamp extends Control {

	public $onSave;
	public $onSaveOpen;

	/** @persistent */
	public $bootcampId;

	/** @var FormBootcampDataSource @inject @internal */
	public $formBootcampDS;

	/** @var BootcampClassRoleRepository @inject @internal */
	public $bootcampClassRoleRepo;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var BootcampProcessManager @inject @internal */
	public $bootcampPM;

	/** @var FormBootcampParticipantDataSource @inject @internal */
	public $formBootcampParticipantDS;

	/** @var CourseRepository @inject @internal */
	public $courseRepo;

	public function render() {

		$this->template->setFile(__DIR__ . "/formBootcamp.latte");
		$this->template->render();
	}

	public function setDefaultsEditBootcamp(?int $id) {
		$this['formBootcamp']->setDefaults(
			$this->formBootcampDS->getDefaults($id)
		);
	}

	public function createComponentFormBootcamp(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->setMappedType(TFormBootcamp::class);

		$form->addHidden('id');
		$form->addText('class_number', 'Číslo třídy')
			->setRequired('Zadejte číslo třídy')
			->getControlPrototype()->placeholder('Zadejte číslo třídy');

		$form->addText('label', 'Název')
			->setRequired('Zadejte název třídy')
			->getControlPrototype()->placeholder('Zadejte název třídy');

		$form->addText('active_since', 'Datum založení')
			->setHtmlType('date');

		$courses = $this->courseRepo->findAllActive()->fetchPairs('id', 'name');
		$form->addMultiSelect('subject_id', 'Kurzy', $courses)->setRequired('Vyberte kurzy');

		$users = $this->userRepo->findAllActive()->fetchPairs('id', 'nick');
		$form->addSelect('main_instructor_id', 'Hlavní instrutor', $users)->setPrompt('?')->setRequired('Vyberte hlavního instruktora');

		$form->addMultiSelect('assistant_instructor_id', 'Mladší instruktoři', $users);

		$form->addMultiSelect('recruit_id', 'Rekruti', $users);

		$form->addSubmit('saveOpen', 'Uložit a otevřít');
		$form->addSubmit('save', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormBootcamp $values) {
			$id = $this->formBootcampDS->save($values);
			$this->flashMessage('Třída byla úspěšně založena.', 'ok');
			if ($form['saveOpen']->isSubmittedBy()) {
				$this->onSaveOpen($id);
			} else {
				$this->onSave();
			}
		};
		return $form;
	}

}