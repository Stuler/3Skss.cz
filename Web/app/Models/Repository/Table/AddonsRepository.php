<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\Selection;

class AddonsRepository extends BaseModel {

	protected $table = 'addons';

	public function fetchAddonsCount($id): int {
		return $this->findAll()->where('framework_instance_id', $id)->count();
	}

	public function findByInstanceId($id): Selection {
		return $this->findAll()->where('framework_instance_id', $id);
	}

	public function fetchAllBySearchTerm(string $searchTerm, array $columns): Selection {
		$allCols = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME ='$this->table' AND TABLE_SCHEMA='skss'")
			->fetchPairs(null, "COLUMN_NAME");
		$likes = [];
		$values = [];
		$selectedCols = [];

		foreach ($columns as $column) {
			$selectedCols[] = $column;
		}

		foreach ($allCols as $column) {
			if (in_array($column, $selectedCols)) {
				$likes[] = "`$column` LIKE ?";
				$values[] = "%$searchTerm%";
			}
		}

		$conditionQuery = implode(" OR ", $likes);

		return $this->db->table($this->table)
			->where($conditionQuery, ...$values);
	}

}