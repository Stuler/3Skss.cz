<?php
declare(strict_types=1);

namespace App\Models;

use App\models\Repository\Table\LoginRoleRepository;
use App\Types\DB\Tables\TDbRole;
use Nette\Security\Permission;

class AuthorizatorFactory {

	/** @var LoginRoleRepository */
	public $loginRoleRepo;

	public function __construct(LoginRoleRepository $loginRoleRepo) {
		$this->loginRoleRepo = $loginRoleRepo;
	}

	public static function create(LoginRoleRepository $roleRepo): Permission {
		$acl = new Permission();

		/** @var TDbRole[] $roles */
		$roles = $roleRepo->findAll()->fetchAll();
		foreach ($roles as $role) {
			$acl->addRole($role->name);
		}

		$acl->addResource('admin');
		$acl->addResource('front');
		$acl->addResource('user');

		$acl->deny('guest');
		$acl->allow('guest', 'front', 'view');
		$acl->allow('guest', 'dashboard', 'view');

		return $acl;
	}

}