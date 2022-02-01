<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Models\DataManager\EventsDataManager;
use App\Models\DataSource\Form\EventFormDataSource;
use App\Models\Repository\Table\EventRepository;
use App\Models\Repository\Table\EventTypeRepository;
use App\models\Repository\Table\UserRepository;
use App\Presenters\_core\BasePresenter;
use App\Types\Form\TFormEvent;
use Nette\Application\UI\Form;

class EventsPresenter extends BasePresenter {

	/** @var EventTypeRepository @inject @internal */
	public $eventTypeRepo;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var EventFormDataSource @inject @internal */
	public $eventFormDS;

	/** @var EventRepository @inject @internal */
	public $eventRepo;

	/** @var EventsDataManager @inject @internal */
	public $eventsDM;

	public function renderDefault() {
		$this->template->events = $this->eventRepo->findAllActive()->fetchAll();
	}

	public function renderEdit(?int $eventId) {
		$event = $this->eventRepo->fetchById($eventId);
		$this->template->eventId = $eventId;
		if ($eventId) {
			$this['formEventEdit']->setDefaults($this->eventFormDS->setDefaultsSelectEvent($eventId));
		}
	}

	public function createComponentFormEventEdit(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');

		$eventTypes = $this->eventTypeRepo->findAll()->fetchPairs('id', 'name');
		$form->addRadioList('event_type_id', 'Typ události', $eventTypes);

		$form->addText('name', 'Název události');
		$form->addText('description', 'Popis');
		$form->addText('date_from', 'Termin začátku')
			->setHtmlType('datetime-local');
		$form->addText('date_to', 'Předpokládaný termín ukončení')
			->setHtmlType('datetime-local');
		$form->addInteger('slots_count', 'Počet slotů');

		$zeus = $this->userRepo->findAll()->fetchPairs('id', 'nick');
		$form->addSelect('zeus', 'Zeus/Instruktor', $zeus);
		$form->addSubmit('create', 'Vytvořit');

		$form->onSuccess[] = function (Form $form, TFormEvent $values) {
			$this->eventFormDS->save($values);
			$this->redirect('events:default');
		};
		return $form;
	}

	public function actionDelete(int $id) {
		$this->eventsDM->delete($id);
		$this->redirect('default');
	}
}