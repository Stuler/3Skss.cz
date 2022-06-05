<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\Selection;

class UserRoleRepository extends BaseModel {

	protected $table = 'user_role';

	/**
	 * Returns user roles by given user id
	 */
	public function fetchByUserId(int $id): array {
		return $this->findAllActive()
			->where('user_id ?', $id)
			->fetchPairs('user_id','login_role_id');
	}

}