<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: course
 * @property int    $id;
 * @property string $name;
 * @property string $abbreviation;
 * @property string $description;
 * @property string $note;
 * @property int    $course_level_id;
 */
class TDbCourse extends ArrayHash {

}