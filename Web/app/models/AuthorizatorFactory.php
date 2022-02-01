<?php
declare(strict_types=1);

namespace App\models;

use App\models\DataManager\RoleRuleDataManager;
use App\models\Repository\Table\LoginRoleRepository;
use App\Types\DB\Tables\TDbRole;
use Nette\Security\Permission;

class AuthorizatorFactory {

	public static function create(RoleRuleDataManager $roleRuleDM, LoginRoleRepository $roleRepo): Permission {
		$acl = new Permission();

		/** @var TDbRole[] $roles */
		$roles = $roleRepo->findAll()->fetchAll();
		foreach ($roles as $role) {
			$acl->addRole((string)$role->id);
		}

		$acl->addResource('DashboardPresenter', 'AdminModule');
		$acl->addResource('UserPresenter', 'AdminModule');
		$acl->addResource('TrainingCenterPresenter', 'AdminModule');
		$acl->addResource('EventsPresenter', 'AdminModule');
		$acl->addResource('TeamsPresenter', 'AdminModule');
		$acl->addResource('AddonsPresenter', 'AdminModule');
		$acl->addResource('FrameworkInstancesPresenter', 'AdminModule');
		$acl->addResource('ExceptionPresenter', 'AdminModule');
		$acl->addResource('HomepagePresenter', 'MemberModule');

		$acl->allow('1', Permission::ALL, Permission::ALL);

		return $acl;
	}

}