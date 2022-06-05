<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\FormDetachment\FormDetachment;
use App\Components\FormDetachment\FormDetachmentFactory;
use App\Components\FormSquad\FormSquad;
use App\Components\FormSquad\FormSquadFactory;
use App\Models\Repository\Table\DetachmentRepository;
use App\models\Repository\Table\SquadRepository;
use App\models\Repository\Table\UserRepository;
use App\Presenters\_core\BasePresenter;

class CombatSectionPresenter extends BaseAdminPresenter {

	/** @var FormSquadFactory @inject @internal */
	public $formSquadFactory;

	/** @var FormDetachmentFactory @inject @internal */
	public $formDetachmentFactory;

	/** @var DetachmentRepository @inject @internal */
	public $detachmentRepo;

	/** @var SquadRepository @inject @internal */
	public $squadRepo;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var int */
	public $squadId;

	public function renderDefault() {
		$this->template->detachments = $this->detachmentRepo->findAllActive()->fetchAll();
		$this->template->squads = $this->squadRepo->findAllActive()->fetchAll();
		$this->template->activeUsers = $this->userRepo->findAllActive()->fetchAll();
	}

	public function renderEdit(?int $id) {

	}

	public function createComponentFormDetachment(): FormDetachment {
		return $this->formDetachmentFactory->create();
	}

	public function createComponentFormSquad(): FormSquad {
		$formSquad = $this->formSquadFactory->create();
		$formSquad->onClick[] = function ($squadId) {
			$this->squadId = $squadId;
			$squad = $this->squadRepo->fetchById($squadId);
			$this['formSquad']->setDefaults($squadId, null, null);
			$this->redrawControl('modalFormSquad');
		};
		return $formSquad;
	}

	public function handleCreateDetachment(?int $centerId) {
		$this['formDetachment']->setDefaultsCreateDetachment($centerId);
		$this->template->showModal = true;
		$this->template->modalName = 'FormDetachment';
		$this->redrawControl("modal");
	}

	public function handleEditDetachment(?int $detachmentId) {
		if ($detachmentId) {
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
			$this['formSquad']->setDefaults($squadId, null, null);
			$this->template->showModal = true;
			$this->template->modalName = 'FormSquad';
			$this->redrawControl("modal");
		}
	}

	public function handleShowModal($name, ?int $id) {
		$this->template->showModal = true;
		$this->template->modalName = $name;

		$this->redrawControl("modal");
	}

	public function handleCloseModal() {
		$this->redrawControl("modal");
	}
}