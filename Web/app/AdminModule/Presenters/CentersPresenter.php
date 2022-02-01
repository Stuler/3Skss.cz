<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\FormDetachment\FormDetachment;
use App\Components\FormDetachment\FormDetachmentFactory;
use App\Components\FormSquad\FormSquad;
use App\Components\FormSquad\FormSquadFactory;
use App\Models\DataSource\Form\CenterException;
use App\Models\DataSource\Form\CenterFormDataSource;
use App\Models\DataSource\Form\DetachmentFormDataSource;
use App\Models\Repository\Table\CenterRepository;
use App\Models\Repository\Table\DetachmentRepository;
use App\models\Repository\Table\SquadRepository;
use App\models\Repository\Table\UserRepository;
use App\Presenters\_core\BasePresenter;
use App\Types\Form\TFormCenter;
use App\Types\Form\TFormDetachment;
use Nette\Application\UI\Form;

class CentersPresenter extends BasePresenter {

	/** @var CenterFormDataSource @inject @internal */
	public $centerFormDS;

	/** @var CenterRepository @inject @internal */
	public $centerRepo;

	/** @var DetachmentFormDataSource @inject @internal */
	public $detachmentFormDS;

	/** @var DetachmentRepository @inject @internal */
	public $detachmentRepo;

	/** @var FormSquadFactory @inject @internal */
	public $formSquadFactory;

	/** @var FormDetachmentFactory @inject @internal */
	public $formDetachmentFactory;

	/** @var SquadRepository @inject @internal */
	public $squadRepository;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/**
	 * @persistent
	 */
	public $centerId;

	/**
	 * @persistent
	 */
	public $detachmentId;

	public function renderDefault() {
		$this->template->centers = $this->centerRepo->findAllActive()->fetchAll();
		$this->template->detachments = $this->detachmentRepo->findAllActive()->fetchAll();
		$this->template->squads = $this->squadRepository->findAllActive()->fetchAll();
		$this->template->activeUsers = $this->userRepo->findAllActive()->fetchAll();
	}

	public function renderEditCenter(?int $id) {
		$this->template->center_id = $this->centerId;
		$center = $this->centerRepo->fetchById($id);
		$this['formCenter']->setDefaults($center);
	}

	public function renderEditDetachment(?int $id) {

	}

	public function createComponentFormCenter(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");

		$form->addHidden('id');
		$form->addText('name', 'Název střediska');
		$form->addText('abbreviation', 'Zkratka');
		$form->addTextArea('description', 'Popis střediska');
		$form->addText('note', 'Poznámka');
		$form->addCheckbox('is_active', 'Aktivní')->setDefaultValue('1');
		$form->addSubmit('save', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormCenter $values) {
			try {
				$id = $this->centerFormDS->save($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->redirect('this');
			} catch (CenterException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function createComponentFormDetachment(): FormDetachment {
		return $this->formDetachmentFactory->create();
	}

	public function createComponentFormSquad(): FormSquad {
		return $this->formSquadFactory->create();
	}

	public function handleCreateDetachment(?int $centerId) {
		$this['formDetachment']->setDefaultsCreateDetachment($centerId);
		$this->template->showModal = true;
		$this->template->modalName = 'FormDetachment';
		$this->redrawControl("modal");
	}

	public function handleEditDetachment(?int $detachmentId) {
		if ($detachmentId) {
			$isEdit = isset($detachmentId);
			$this['formDetachment']->detachmentId = $detachmentId;
			$this['formDetachment']->isEdit = $isEdit;
			$this['formDetachment']->setDefaultsEditDetachment($detachmentId);
			$this->template->showModal = true;
			$this->template->modalName = 'FormDetachment';
			$this->redrawControl("modal");
		}
	}

	public function handleCreateSquad(?int $squadTypeId, ?int $centerId) {
		$this['formSquad']->setDefaults(null, $squadTypeId, $centerId);
		$this->template->showModal = true;
		$this->template->modalName = 'FormSquad';
		$this->redrawControl("modal");
	}

	public function handleEditSquad(?int $squadId, ?int $centerId, ?int $detachmentId) {
		if ($squadId) {
			$isEdit = isset($squadId);
			$this['formSquad']->squadId = $squadId;
			$this['formSquad']->isEdit = $isEdit;
			$this['formSquad']->setDefaults($squadId, null, null);
			$this->template->showModal = true;
			$this->template->modalName = 'FormSquad';
			$this->redrawControl("modal");
		}
	}

	public function handleEditUser(int $userId) {
		$this->redirect(':Admin:users:edit', ['userId' => $userId]);
	}

	public function handleShowModal($name, ?int $id) {
		$this->template->showModal = true;
		$this->template->modalName = $name;

		$this->redrawControl("modal");
	}

	public function handleCloseModal() {
		$this->redrawControl("modal");
	}

	public function handleDeleteSquad($id) {
	}

}