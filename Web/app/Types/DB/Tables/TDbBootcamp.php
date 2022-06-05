<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * @property int       $id;
 * @property string    $class_number;
 * @property string    $label;
 * @property int       $is_active;
 * @property \DateTime $active_since;
 * @property \DateTime $active_until;
 * @property \DateTime $date_created;
 * @property \DateTime $date_modified;
 * @property \DateTime $date_deleted;
 * @property int       $created_by;
 * @property int       $deleted_by;
 */
class TDbBootcamp extends ArrayHash {

}