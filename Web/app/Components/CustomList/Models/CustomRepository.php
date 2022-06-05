<?php
declare(strict_types=1);

namespace App\Components\CustomList\Models;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\Selection;

class CustomRepository extends BaseModel {

	public function fetchAllCustom(string $tableName, ?string $relativeColumn, ?int $relativeValue, ?array $columns, ?string $searchTerm = null): Selection {
		$allCols = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME ='$tableName' AND TABLE_SCHEMA='skss'")
			->fetchPairs(null, "COLUMN_NAME");
		$likes = [];
		$values = [];
		$selectedCols = [];

		foreach ($columns as $column) {
			$selectedCols[] = $column['name'];
		}

		foreach ($allCols as $column) {
			if (in_array($column, $selectedCols)) {
				$likes[] = "`$column` LIKE ?";
				$values[] = "%$searchTerm%";
			}
		}

		$conditionQuery = implode(" OR ", $likes);

		if (!$searchTerm) {
			if (!$relativeColumn) {
				return $this->db->table($tableName);
			} else {
				return $this->db->table($tableName)
					->where($relativeColumn, $relativeValue);
			}
		} else {
			return $this->db->table($tableName)
				->where($conditionQuery, ...$values);
		}
	}

	public function getColumnNames($tableName): array {
		return $this->db->query("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME ='$tableName' AND TABLE_SCHEMA='skss'")
			->fetchPairs(null, "COLUMN_NAME");
	}

	public function getDistinctRows($relativeCol): array {
		return $this->db->query("SELECT * FROM server_agents")
			->fetchPairs(null, 'id');
	}
}