<?php
declare(strict_types=1);

namespace App\models\Repository\Table;

use App\models\BaseModel\BaseModel;

class RoleRepository extends BaseModel {

	protected $table = 'role';

	public function fetchPairs() {
		return $this->db->table($this->table)->fetchPairs('id', 'name');
	}
}