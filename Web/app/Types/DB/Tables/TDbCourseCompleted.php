<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: course_completed
 * @property int       $id;
 * @property int       $user_id;
 * @property \DateTime $completition_date;
 * @property int       $instructor_id;
 * @property int       $course_id;
 * @property int       $course_completition_type_id;
 * @property string    $note;
 */
class TDbCourseCompleted extends ArrayHash {

}