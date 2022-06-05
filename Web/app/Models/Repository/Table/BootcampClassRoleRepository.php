<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;

class BootcampClassRoleRepository extends BaseModel {

	protected $table = 'bootcamp_class_role';

	public const MAIN_INSTRUCTOR = 1;
	public const ASSISTANT_INSTRUCTOR = 2;
	public const RECRUIT = 3;
}