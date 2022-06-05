<?php
declare(strict_types=1);

namespace App\MemberModule\Presenters;

use App\models\Repository\Table\UserRepository;
use App\Presenters\_core\BasePresenter;

class UsersPresenter extends BasePresenter {

	/**
	 * @persistent
	 */
	public $userId;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	public function __construct() {
		parent::__construct();
	}

	public function renderDefault() {
		$this->template->members = $this->userRepo->findAllActive()->fetchAll();
	}

	public function renderEdit(?int $userId) {

	}

}