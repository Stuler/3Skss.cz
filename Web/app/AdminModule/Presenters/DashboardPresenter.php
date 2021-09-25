<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use Nette\Database\Explorer;

class DashboardPresenter extends \Nette\Application\UI\Presenter {

	/** @var \Nette\Database\Context */
	private $db;

	public function __construct(Explorer $db) {
		$this->db = $db;
	}

	public function renderDefault() {
		$this->template->text = "Dashboard";
	}

}