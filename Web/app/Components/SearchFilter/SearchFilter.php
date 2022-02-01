<?php
declare(strict_types=1);

namespace App\Components\SearchFilter;

use App\Components\SearchFilter\Models\SearchFilterRepository;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class SearchFilter extends Control {

	/** @var SearchFilterRepository @inject @internal */
	public $searchFilterRepo;

	private $searchTerm;

	private $filterTerm;

	private $tableName;

	private $columns;

	/** @var int hodnota foreignId */
	private $relationValue;

	/** @var string spolocny stlpec pre vykreslenie dat podla foreignId */
	private $relationColumn;

	private $isShowFilter = false;

	private $isShowSearch = false;

	private $searchSnippet = 'list';

	public function render() {
		$this->template->columns = $this->columns;
		$this->template->items = $this->searchFilterRepo->fetchAllCustom($this->tableName, $this->relationColumn, $this->relationValue, $this->searchTerm, $this->columns);
		$this->template->isShowFilter = $this->isShowFilter;
		$this->template->isShowSearch = $this->isShowSearch;

		$this->template->setFile(__DIR__ . "/searchFilter.latte");
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
			$this->redrawControl($this->searchSnippet);
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

	public function showFilter() {
		$this->isShowFilter = true;
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

	public function showSearch() {
		$this->isShowSearch = true;
	}

	public function setSnippet($snippet) {
		$this->searchSnippet = '' . $snippet;
	}
}