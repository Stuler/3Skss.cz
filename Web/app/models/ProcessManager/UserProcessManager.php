<?php
declare(strict_types=1);

namespace App\models\ProcessManager;

use App\models\BaseModel\BaseModel;

use App\models\Repository\Table\UserRepository;
use Nette\Database\Explorer;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\SmartObject;

class UserProcessManager implements IAuthenticator {
	use SmartObject;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var Explorer */
	private $db;

	/** @var Passwords */
	private $passwords;

	public function __construct(Explorer $db, Passwords $passwords) {
		$this->db = $db;
		$this->passwords = $passwords;
	}

	/**
	 * Performs an authentication.
	 * @throws AuthenticationException
	 */
	function authenticate($credentials): IIdentity {
		[$email, $password] = $credentials;

		$user = $this->userRepo->fetchByEmail($email);

		if (!$user) {
			throw new AuthenticationException('Zadané uživatelské jméno/email neexistuje.', self::IDENTITY_NOT_FOUND);
		} elseif (!$this->passwords->verify($password, $user['password'])) {  // Ověří zadané heslo.
			throw new AuthenticationException('Zadané heslo není správně.', self::INVALID_CREDENTIAL);
		} elseif ($this->passwords->needsRehash($user['password'])) { // Zjistí zda heslo potřebuje rehashovat.
			// Rehashuje heslo (bezpečnostní opatření).
			$user->update([
				'password' => $this->passwords->hash($password),
			]);
		}
	}
}