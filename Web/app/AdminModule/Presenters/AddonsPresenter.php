<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\CustomList\CustomList;
use App\Components\CustomList\CustomListFactory;
use App\Models\Repository\Table\AddonsRepository;
use App\Models\Repository\Table\ServerAgentsRepository;
use App\Presenters\_core\BasePresenter;
use Nette\Application\UI\Form;

class AddonsPresenter extends BaseAdminPresenter {

	/** @var CustomListFactory @inject @internal */
	public $customListFactory;

	/** @var AddonsRepository @inject @internal */
	public $addonsRepo;

	/** @var ServerAgentsRepository @inject @internal */
	public $frameworkInstancesRepo;

	public function renderDefault() {

	}

	public function createComponentCustomListAddons(): CustomList {
		$customList = $this->customListFactory->create();
		$customList->showFilter();
		$customList->setTable('addons');
		$allCols = $this->addonsRepo->getColumnNames('addons');
		foreach ($allCols as $col) {
			$customList->addColumn($col, '' . $col);
		}
		return $customList;
	}

}