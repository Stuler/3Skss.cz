<?php

declare(strict_types=1);

namespace App\MemberModule\Presenters;

use App\Presenters\_core\BasePresenter;
use Nette;
use Nette\Database\Explorer;

final class MemberDashboardPresenter extends BasePresenter {

	public function renderDefault(): void {
		$t = $this->template;
	}

}
