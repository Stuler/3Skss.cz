<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: bootcamp_class_participant
 * @property int       $id;
 * @property int       $bootcamp_class_id;
 * @property int       $role_id;
 * @property int       $user_id;
 * @property int       $training_status_id;
 * @property \DateTime $date_from;
 * @property \DateTime $date_to;
 * @property \DateTime $date_change;
 * @property \DateTime $date_not_ready;
 * @property \DateTime $date_ready;
 * @property \DateTime $date_mandatory;
 * @property \DateTime $date_discarded;
 * @property \DateTime $date_modified;
 * @property \DateTime $date_deleted;
 * @property \DateTime $date_created;
 * @property int       $slots_count;
 * @property int       $created_by;
 */
class TDbBootcampParticipant extends ArrayHash {

}