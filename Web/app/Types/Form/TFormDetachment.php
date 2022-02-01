<?php
declare(strict_types=1);

namespace App\Types\Form;

class TFormDetachment {
	public $id;
	public $name;
	public $description;
	public $abbreviation;
	public $parent_detachment_id;
	public $center_id;
	public $note;
	public $is_active;
}