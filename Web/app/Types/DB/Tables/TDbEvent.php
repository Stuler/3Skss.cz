<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: event
 * @property int       $id;
 * @property int       $event_type_id;
 * @property string    $name;
 * @property string    $description;
 * @property \DateTime $date_from;
 * @property \DateTime $date_to;
 * @property int       $slots_count;
 * @property int       $zeus;
 * @property int       $created_by;
 */
class TDbEvent extends ArrayHash {

}