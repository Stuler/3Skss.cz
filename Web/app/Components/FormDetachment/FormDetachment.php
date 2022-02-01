<?php
declare(strict_types=1);

namespace App\Components\FormDetachment;

use App\Models\DataManager\DetachmentDataManager;
use App\Models\DataSource\Form\DetachmentFormDataSource;
use App\Models\Repository\Table\CenterRepository;
use App\Types\Form\TFormDetachment;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class FormDetachment extends Control {

	/** @var CenterRepository @inject @internal */
	public $centerRepo;

	/** @var DetachmentFormDataSource @inject @internal */
	public $detachmentFormDS;

	/** @var DetachmentDataManager @inject @internal */
	public $detachmentDM;

	/** @var int */
	public $detachmentId;

	public $isEdit = false;

	public function render() {
		$this->template->detachmentId = $this->detachmentId;
		$this->template->isEdit = $this->isEdit;
		$this->template->setFile(__DIR__ . "/formDetachment.latte");
		$this->template->render();
	}

	public function setDefaultsCreateDetachment(?int $centerId) {
		$this['formDetachment']->setDefaults($this->detachmentFormDS->getDefaultsCreateDetachment($centerId));
	}

	public function setDefaultsEditDetachment(?int $detachmentId) {
		$this['formDetachment']->setDefaults($this->detachmentFormDS->getDefaultsEditDetachment($detachmentId));
	}

	public function createComponentFormDetachment(): Form {
		$form = new Form();
		$centers = $this->centerRepo->findAll()->fetchPairs('id', 'name');

		$form->addHidden('id');
		$form->addText('name', 'Název odřadu');
		$form->addTextArea('description', 'Popis odřadu');
		$form->addText('abbreviation', 'Zkratka');
		$form->addSelect('center_id', 'Středisko', $centers);
		$form->addText('note', 'Poznámka');
		$form->addCheckbox('is_active', 'Aktivní')->setDefaultValue('1');
		$form->addSubmit('save', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormDetachment $values) {
			$id = $this->detachmentFormDS->save($values);
			$this->flashMessage('Změny byly provedeny.', 'ok');
			$this->redirect('this');
		};
		return $form;
	}

	public function handleDeleteDetachment(int $id) {
		$this->detachmentDM->delete($id);
	}

}