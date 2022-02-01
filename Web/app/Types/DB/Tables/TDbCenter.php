<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: center
 * @property int    $id;
 * @property string $name;
 * @property string $note;
 * @property string $description;
 * @property string $abbreviation;
 * @property int    $is_active;
 * @property int    $created_by;
 */
class TDbCenter extends ArrayHash {

}