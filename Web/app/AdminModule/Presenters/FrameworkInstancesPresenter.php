<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\CustomList\CustomList;
use App\Components\CustomList\CustomListFactory;
use App\Models\Repository\Table\FrameworkInstancesRepository;
use App\Presenters\_core\BasePresenter;
use Nette\Application\UI\Form;

class FrameworkInstancesPresenter extends BasePresenter {

	/** @var CustomListFactory @inject @internal */
	public $customListFactory;

	/** @var FrameworkInstancesRepository @inject @internal */
	public $frameworkInstancesRepo;

	public function renderDefault() {

	}

	public function createComponentCustomListInstances(): CustomList {
		$customList = $this->customListFactory->create();
		$customList->showFilter();
		$customList->setTable('framework_instances');

		$allCols = $this->frameworkInstancesRepo->getColumnNames('framework_instances');
		foreach ($allCols as $col) {
			$customList->addColumn($col, '' . $col);
		}
		return $customList;
	}
}