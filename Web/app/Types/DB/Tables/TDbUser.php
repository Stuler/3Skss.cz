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
 * @property  string    $role;
 * @property  \DateTime $date_created;
 * @property  int       $rank_id;
 * @property  int       $squad_id;
 * @property  int       $squad_pos;
 * @property  int       $tactical_points;
 * @property  int       $penalty;
 * @property  int       $is_active;
 * @property  int       $is_basic_infantry;
 * @property  int       $is_advanced_tactics;
 * @property  int       $is_medic_shooter;
 * @property  int       $is_cls;
 * @property  int       $is_doctor;
 * @property  int       $is_rto_1_cz;
 * @property  int       $is_rto_2_cz;
 * @property  int       $is_rto_1_en;
 * @property  int       $is_rto_2_en;
 * @property  int       $is_heli_1;
 * @property  int       $is_heli_2;
 * @property  int       $is_heli_3;
 * @property  int       $is_jet_1;
 * @property  int       $is_jet_2;
 * @property  int       $is_jet_3;
 * @property  int       $is_engineer_basic;
 * @property  int       $is_engineer_adv;
 * @property  int       $is_sniper;
 * @property  int       $is_jtac_basic;
 * @property  int       $is_jtac_adv;
 * @property  int       $is_driver;
 * @property  string    $note;
 *
 *
 * @method \Nette\Database\Table\GroupedSelection related(string $key, string $throughColumn = null)
 * @method \Nette\Database\Table\IRow|null ref(string $key, string $throughColumn = null)
 **/
class TDbUser extends ArrayHash {

}