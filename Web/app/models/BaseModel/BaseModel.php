<?php
declare(strict_types=1);

namespace App\models\BaseModel;

use Nette\SmartObject;

use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

use Nette\Utils\ArrayHash;

class BaseModel {

	use SmartObject;

	/** @var Context */
	protected $db;

	/** @var string */
	protected $table = "";

	/**
	 * @param Context $db
	 */
	function __construct(Context $db) {
		$this->db = $db;
	}

	/**
	 * @return Selection
	 */
	public function findAll() {
		return $this->db->table($this->table);
	}

}