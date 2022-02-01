<?php
declare(strict_types=1);

namespace App\Components\CustomList;

use App\Components\CustomList\Models\CustomRepository;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class CustomList extends Control {

	/** @var CustomRepository @inject @internal */
	public $customRepo;

	/** @var string nazov tabulky, z ktorej taham data */
	private $tableName;

	/** @var int hodnota foreignId */
	private $relationValue;

	/** @var string spolocny stlpec pre vykreslenie dat podla foreignId */
	private $relationColumn;

	/** @var array zoznam stlpcov dat na vykreslenie */
	private $columns = [];

	/** @var array */
	public $onClick;

	private $searchTerm;

	private $filterTerm;

	private $isShowFilter = false;

	public function render() {
		/**
		 * pre vypis klientov potrebujem:
		 * - nazov tabulky
		 * - vyber stlpcov z db
		 */
		$this->template->columns = $this->columns;
		$this->template->items = $this->customRepo->fetchAllCustom($this->tableName, $this->relationColumn, $this->relationValue, $this->searchTerm, $this->columns);
		$this->template->isShowFilter = $this->isShowFilter;
		$this->template->setFile(__DIR__ . "/customList.latte");
		$this->template->render();
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
			$this->redrawControl("list");
		};
		return $form;
	}

	public function createComponentFormFilter(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");

		$columns = $this->customRepo->getColumnNames($this->tableName);
		$columnsFilter = $form->addSelect('column', 'Sloupec', $columns)->setPrompt('?');

		$rows = $this->customRepo->getDistinctRows($this->tableName);
		$rowFilter = $form->addSelect('row', 'Řádek', $rows);
		$form->addSubmit('filter', 'Odfiltrovat');
		$form->addSubmit("clear", "Vyčistit");

		$form->onSuccess[] = function (Form $form, $values) {
			if ($form['filter']->isSubmittedBy()) {
				$this->filterTerm = $values['term'];
			} else {
				$form->reset();
				$this->redrawControl("formFilter");
			}
			$this->redrawControl("list");
		};
		return $form;
	}

	public function handleEditCustom(?int $id) {
		$this->onClick($id);
	}

	public function setTable(string $tableName) {
		$this->tableName = $tableName;
	}

	public function addColumn(string $columnName, string $label) {
		$this->columns[] = ["name" => $columnName, "label" => $label];
	}

	public function setRelation(string $column, int $relationValue) {
		$this->relationColumn = $column;
		$this->relationValue = $relationValue;
	}

	/** Moznost zobrazenia vyhladavacieho formulara */
	public function showFilter() {
		$this->isShowFilter = true;
	}

}