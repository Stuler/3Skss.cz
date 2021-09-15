<?php
declare(strict_types=1);

namespace App\models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\Selection;

class UserRepository extends BaseModel {

	protected $table = 'user';

	/**
	 * Zákl. dotaz vracia nezmazané záznamy
	 */
	public function findAllActive(): Selection {
		return $this->findAll()->where('date_deleted IS NULL');
	}
}