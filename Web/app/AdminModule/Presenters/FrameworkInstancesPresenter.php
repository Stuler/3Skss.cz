<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\CustomList\CustomList;
use App\Components\CustomList\CustomListFactory;
use App\Models\Repository\Table\ServerAgentsRepository;
use App\Presenters\_core\BasePresenter;
use Nette\Application\UI\Form;

class FrameworkInstancesPresenter extends BaseAdminPresenter {

	/** @var CustomListFactory @inject @internal */
	public $customListFactory;

	/** @var ServerAgentsRepository @inject @internal */
	public $frameworkInstancesRepo;

	public function renderDefault() {

	}

	public function createComponentCustomListInstances(): CustomList {
		$customList = $this->customListFactory->create();
		$customList->showFilter();
		$customList->setTable('server_agents');

		$allCols = $this->frameworkInstancesRepo->getColumnNames('server_agents');
		foreach ($allCols as $col) {
			$customList->addColumn($col, '' . $col);
		}
		return $customList;
	}
}