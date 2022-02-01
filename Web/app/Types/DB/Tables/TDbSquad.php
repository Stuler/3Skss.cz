<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: squad
 * @property int    $id;
 * @property string $name;
 * @property string $abbreviation;
 * @property string $description;
 * @property int    $squad_type_id;
 * @property int    $center_id;
 * @property int    $detachment_id;
 * @property int    $is_active;
 * @property int    $created_by;
 * @property string $note;
 *
 * @method \Nette\Database\Table\GroupedSelection related(string $key, string $throughColumn = null)
 * @method \Nette\Database\Table\IRow|null ref(string $key, string $throughColumn = null)
 **/
class TDbSquad extends ArrayHash {

}