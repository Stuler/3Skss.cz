<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;

class LoginRoleRepository extends BaseModel {

	protected $table = 'login_role';

	public const ROLE_ADMIN = 1;
	public const ROLE_MEMBER = 2;

}