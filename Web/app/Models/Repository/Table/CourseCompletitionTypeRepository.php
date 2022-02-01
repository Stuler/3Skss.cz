<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;

class CourseCompletitionTypeRepository extends BaseModel {

	protected $table = 'course_completition_type';

	const FULFILLED = 1;
	const UNFULFILLED = 2;
	const IN_PROGRESS = 3;
	const INSTRUCTOR = 4;

}