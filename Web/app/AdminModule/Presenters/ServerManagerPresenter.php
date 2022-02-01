<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Models\Repository\Table\AddonsRepository;
use App\Models\Repository\Table\FrameworkInstancesRepository;
use App\Presenters\_core\BasePresenter;
use Nette\Application\UI\Form;

class ServerManagerPresenter extends BasePresenter {

	/** @var FrameworkInstancesRepository @inject @internal */
	public $frameworkInstancesRepo;

	/** @var AddonsRepository @inject @internal */
	public $addonsRepo;

	/** @persistent */
	public $showDownloaded;

	/** @persistent */
	public $sorted;

	public $sortedColumn;

	public $sortOrder;

	public $searchTerm;

	private $filterTerm;

	public function renderDefault() {
		$instances = $this->frameworkInstancesRepo->findAll()->fetchAll();
		$this->template->instances = $instances;
	}

	public function renderShow(int $id) {

		if ($this->searchTerm) {
			$addons = $this->addonsRepo->fetchAllBySearchTerm($this->searchTerm, ['addon_id', 'addon_name']);
		} elseif ($this->showDownloaded) {
			$addons = $this->addonsRepo->findByInstanceId($id)
				->where('status', 1);
		} elseif ($this->sorted) {
			$addons = $this->addonsRepo->findByInstanceId($id)->order($this->sortedColumn, $this->sortOrder);
		} else {
			$addons = $this->addonsRepo->findByInstanceId($id);
		}

		$this->template->addons = $addons;
		$this->template->showDownloaded = $this->showDownloaded;
		$this->template->sorted = $this->sorted;
	}

	public function createComponentFormSearch(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");

		$form->addText("term");

		$form->addSubmit("send", "Vyhledat");
		$form->addSubmit("clear", "Vyčistit");

		$form->onSuccess[] = function (Form $form, $values) {
			if ($form['send']->isSubmittedBy()) {
				$this->searchTerm = $values['term'];
			} else {
				$form->reset();
				$this->redrawControl("formSearch");
			}
			$this->redrawControl('addons');
		};
		return $form;
	}

	public function handleFilterDownloaded(bool $status) {
		if ($status == true) {
			$this->showDownloaded = true;
		} else {
			$this->showDownloaded = false;
		}
		$this->redrawControl('addons');
	}

	public function handleSort(bool $status, string $column, string $order) {
		if ($status == true) {
			$this->sorted = true;
		} else {
			$this->sorted = false;
		}
		$this->sortedColumn = $column;
		$this->sortOrder = $order;
		$this->redrawControl('addons');
	}

	public function getCount($id) {
		return $this->addonsRepo->fetchAddonsCount($id);
	}

	public function handleCheckServer() {

	}

}