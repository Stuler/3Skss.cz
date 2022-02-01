<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: user
 * @property  int       $id;
 * @property  string    $nick;
 * @property  string    $email;
 * @property  string    $password;
 * @property  string    $discord_id;
 * @property  string    $steam_id;
 * @property  string    $login_role_id;
 * @property  \DateTime $date_created;
 * @property  int       $rank_id;
 * @property  int       $squad_id;
 * @property  int       $squad_pos;
 * @property  int       $tactical_points;
 * @property  int       $penalty;
 * @property  int       $is_active;
 * @property  string    $note;
 *
 *
 * @method \Nette\Database\Table\GroupedSelection related(string $key, string $throughColumn = null)
 * @method \Nette\Database\Table\IRow|null ref(string $key, string $throughColumn = null)
 **/
class TDbUser extends ArrayHash {

}