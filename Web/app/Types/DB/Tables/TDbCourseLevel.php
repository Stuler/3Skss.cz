<?php
declare(strict_types=1);

namespace App\Types\DB\Tables;

use Nette\Utils\ArrayHash;

/**
 * Table: course_family
 * @property int    $id;
 * @property string $name;
 * @property string $abbreviation;
 * @property string $description;
 * @property string $note;
 * @property int    $required_course_level;
 */
class TDbCourseLevel extends ArrayHash {

}