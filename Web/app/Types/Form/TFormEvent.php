<?php
declare(strict_types=1);

namespace App\Types\Form;

class TFormEvent {
	public $id;
	public $event_type_id;
	public $name;
	public $description;
	public $date_from;
	public $date_to;
	public $slots_count;
	public $zeus;
	/**
	 * @var int
	 */
	public $created_by;
}