<?php
declare(strict_types=1);

namespace App\models;

use App\models\Repository\Table\UserRepository;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\UniqueConstraintViolationException;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\Identity;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;
use Nette\SmartObject;

class UserManager implements Authenticator {
	use SmartObject;

	private const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'username',
		COLUMN_PASSWORD_HASH = 'password',
		COLUMN_EMAIL = 'email',
		COLUMN_ROLE = 'role';

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var Explorer */
	private $db;

	/** @var Passwords */
	private $passwords;

	protected $table = 'user';

	public function __construct(Explorer $db, Passwords $passwords) {
		$this->db = $db;
		$this->passwords = $passwords;
	}

	/**
	 * Performs an authentication.
	 * @throws AuthenticationException
	 */
	public function authenticate($user, $password): IIdentity {

		$row = $this->db->table($this->table)
			->where('nick', $user)
			->fetch();

		if (!$row) {
			throw new AuthenticationException('User not found.');
		} elseif (!$this->passwords->verify($password, $row->password)) {  // Ověří zadané heslo.
			throw new AuthenticationException('Zadané heslo není správně.');
		} elseif ($this->passwords->needsRehash($row->password)) { // Zjistí zda heslo potřebuje rehashovat.
			// Rehashuje heslo (bezpečnostní opatření).
			$row->update([
				'password' => $this->passwords->hash($password),
			]);
		}

		$arr = $row->toArray();
		unset($arr['password']);
		return new SimpleIdentity($row->id, $row->role, $arr);
	}

	/*
	* Vhodné pro vlastní authenticator, který má jinou logiku či jiné sloupce
	* @param $email
	* @return false|ActiveRow
	*/
	public function fetchByEmail($email): ?ActiveRow {
		return $this->db->table($this->table)
			->where('email', $email)
			->where('is_active', 1)
			->fetch();
	}

	public function fetchByNick($nick): ?ActiveRow {
		return $this->db->table($this->table)
			->where('nick', $nick)
			//			->where('is_active', 1)
			->fetch();
	}

	public function fetchById($id): ?ActiveRow {
		return $this->db->table($this->table)
			->where('id', $id)
			->where('is_active', 1)
			->fetch();
	}

	public function createIdentity(int $loginId): Identity {
		$row = $this->fetchById($loginId);
		if (!$row) {
			throw new AuthenticationException('User was deactivated.');
		}
		$values = $row->toArray();
		$role = $row['role'];
		return new Identity($row['id'], (string)$role, $values);
	}

	public function loggedUserValues($values) {
		if (array_key_exists('password', $values)) {
			unset($values['password']);
		}

		return $values;
	}

	/**
	 * @throws DuplicateNameException
	 */
	public function add($username, $email, $password) {
		try {
			$this->database->table($this->table)->insert([
				self::COLUMN_NAME          => $username,
				self::COLUMN_PASSWORD_HASH => $this->passwords->hash($password),
				self::COLUMN_EMAIL         => $email,
			]);
		} catch (UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}
}

class DuplicateNameException extends \Exception {
}