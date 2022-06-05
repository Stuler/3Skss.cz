<?php
declare(strict_types=1);

namespace App\models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

class UserRepository extends BaseModel {

	protected $table = 'user';

	public function findSuperAdmin(): Selection {
		return $this->findAll()->where('is_super_admin ?', 1);
	}

	/**
	 * Returns all not deleted records
	 */
	public function findAllActive(): Selection {
		return $this->findAll()->where('NOT (nick ?)', 'admin')->where('user.date_deleted IS NULL');
	}

	/**
	 * Suitable for custom authenticator
	 */
	public function fetchByEmail(string $email): ActiveRow {
		return $this->findAllActive()
			->where('email', $email)
			->where('is_active', 1)
			->fetch();
	}

	/**
	 * Returns user data by given nick
	 */
	public function fetchByNick(string $nick): ActiveRow {
		return $this->findAllActive()
			->where('nick', $nick)
			->where('is_active', 1)
			->fetch();
	}

	/**
	 * Returns id of super admin
	 */
	public function fetchSuperAdmin(): ActiveRow {
		return $this->findAllActive()
			->select('id')
			->where('is_super_admin', 1)
			->limit(1)
			->fetch();
	}
}