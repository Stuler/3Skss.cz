<?php
declare(strict_types=1);

namespace App\models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

class UserRepository extends BaseModel {

	protected $table = 'user';

	/**
	 * Zákl. dotaz vracia nezmazané záznamy
	 */
	public function findAllActive(): Selection {
		return $this->findAll()->where('user.date_deleted IS NULL');
	}

	/**
	 * Vhodné pro vlastní authenticator, který má jinou logiku či jiné sloupce
	 * @param $email
	 * @return ActiveRow
	 */
	public function fetchByEmail($email): ActiveRow {
		return $this->db->table($this->table)
			->where('email', $email)
			->where('is_active', 1)
			->fetch();
	}
}