<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: instructor
 * @property int    $id;
 * @property int    $user_id;
 * @property int    $course_id;
 * @property string $note;
 * @property string $created_by;
 */
class TDbInstructor extends ArrayHash {

}