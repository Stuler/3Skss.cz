<?php
declare(strict_types=1);

namespace App\models;

use App\models\DataManager\RoleRuleDataManager;
use App\models\Repository\Table\RoleRepository;
use App\Types\DB\Tables\TDbRole;
use Nette\Security\Permission;

class AuthorizatorFactory {

	public static function create(RoleRuleDataManager $roleRuleDM, RoleRepository $roleRepo): Permission {
		$acl = new Permission();

		/** @var TDbRole[] $roles */
		$roles = $roleRepo->findAll()->fetchAll();
		foreach ($roles as $role) {
			$acl->addRole((string)$role->id);
		}

		$acl->addResource('DashboardPresenter', 'AdminModule');
		$acl->addResource('HomepagePresenter', 'MemberModule');

		$acl->allow('1', Permission::ALL, Permission::ALL);

		return $acl;
	}

}