<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: detachment
 * @property int    $id;
 * @property string $name;
 * @property string $description;
 * @property string $abbreviation;
 * @property int    $center_id;
 * @property int    $parent_detachment_id;
 * @property string $note;
 * @property int    $is_active;
 * @property int    $created_by;
 */
class TDbDetachment extends ArrayHash {

}