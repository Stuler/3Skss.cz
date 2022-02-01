<?php
declare(strict_types=1);

namespace App\Components\FormSquad;

use App\Models\DataManager\SquadDataManager;
use App\Models\DataSource\Form\SquadException;
use App\Models\DataSource\Form\SquadFormDataSource;
use App\Models\Repository\Table\CenterRepository;
use App\Models\Repository\Table\DetachmentRepository;
use App\models\Repository\Table\SquadRepository;
use App\Models\Repository\Table\SquadTypeRepository;
use App\Types\Form\TFormSquad;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Bridges\ApplicationLatte\Template;

class FormSquad extends Control {

	/** @var CenterRepository @inject @internal */
	public $centerRepo;

	/** @var DetachmentRepository @inject @internal */
	public $detachmentRepo;

	/** @var SquadTypeRepository @inject @internal */
	public $squadTypeRepo;

	/** @var SquadRepository @inject @internal */
	public $squadRepo;

	/** @var SquadFormDataSource @inject @internal */
	public $squadFormDS;

	/** @var SquadDataManager @inject @internal */
	public $squadDM;

	/** @var array */
	public $onClick;

	/** @var int */
	public $squadId;

	public $isEdit = false;

	public function render() {
		$this->template->squadId = $this->squadId;
		$this->template->isEdit = $this->isEdit;
		$this->template->setFile(__DIR__ . "/formSquad.latte");
		$this->template->render();
	}

	public function setDefaults(?int $squadId, ?int $squadTypeId, ?int $centerId) {
		$this['formSquad']->setDefaults($this->squadFormDS->getDefaults($squadId, $squadTypeId, $centerId));
	}

	public function createComponentFormSquad() {
		$form = new Form();

		$squadTypes = $this->squadTypeRepo->findAll()->fetchPairs('id', 'name');
		$centers = $this->centerRepo->findAll()->fetchPairs('id', 'name');
		$detachments = $this->detachmentRepo->findAll()->fetchPairs('id', 'name');
		$squads = $this->squadRepo->findAll()->fetchPairs('id', 'name');

		$form->addHidden('id');
		$form->addText('name', 'Název');
		$form->addText('abbreviation', 'Zkratka');
		$form->addText('description', 'Popis');

		$form->addSelect('squad_type_id', 'Typ družstva', $squadTypes);
		$form->addSelect('center_id', 'Středisko', $centers);
		$form->addSelect('detachment_id', 'Odřad', $detachments)->setPrompt('?');

		$form->addCheckbox('is_active', 'Aktivní')->setDefaultValue('1');
		$form->addText('note', 'poznámka');
		$form->addSubmit('save', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormSquad $values) {
			try {
				$id = $this->squadFormDS->save($values);
				//				$this->redrawControl('modalFormSquad');
			} catch (SquadException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function handleDeleteSquad(int $id) {
		$this->squadDM->delete($id);
	}
}

class TFormSquadTemplate extends Template {
	public $isEdit;
	public $squadId;
}
