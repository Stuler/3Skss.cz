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

	/**
	 * @param array|ArrayHash $values
	 * @return int
	 */
	public function save($values) {
		if ($values instanceof ArrayHash) {
			$values = (array)$values;
		}

		if ($this->isSetId($values)) {
			$id = $values['id'];
			unset($values['id']);
			$this->db->query("UPDATE `$this->table` SET ? WHERE id = ?", $values, $id);
			return intval($id);
		} else {
			if (array_key_exists('id', $values)) {
				unset($values['id']);
			}
			$this->db->query("INSERT INTO `$this->table`", $values);
			return intval($this->db->getInsertId());
		}
	}

}