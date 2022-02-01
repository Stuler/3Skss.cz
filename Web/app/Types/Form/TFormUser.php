<?php
declare(strict_types=1);

namespace App\Types\Form;

class TFormUser {

	public $id;
	public $nick;
	public $email;

	/**
	 * @var \DateTime
	 */
	public $date_created;

	public $password;
	public $discord_id;
	public $steam_id;
	public $login_role_id;
	public $rank_id;
	public $squad_id;
	public $squad_pos;
	public $tactical_points;
	public $penalty;
	public $is_active;
	public $note;
}