<?php
declare(strict_types=1);

namespace App\Components\SearchFilter\Models;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\Selection;

class SearchFilterRepository extends BaseModel {

	public function fetchAllCustom(string $tableName, ?string $relativeColumn, ?int $relativeValue, ?string $searchTerm = null, ?array $columns): Selection {
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
		return $this->db->query("SELECT * FROM framework_instances")
			->fetchPairs(null, 'id');
	}

	public function setSearchColumns() {

	}
}