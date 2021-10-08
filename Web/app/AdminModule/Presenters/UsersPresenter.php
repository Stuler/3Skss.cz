<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\models\Repository\Table\UserRepository;
use App\Presenters\_core\BasePresenter;

/**
 * Základní presenter pro správu uživatelů
 * Možnosti:
 * 1. výpis členů
 * 2. upravit člena
 * 3. smazat člena
 */
class UsersPresenter extends BasePresenter {

	/** @var UserRepository */
	private $userRepo;
}