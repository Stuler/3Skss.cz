<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;

class TrainingStatusRepository extends BaseModel {

	protected $table = 'training_status';

	const NOT_READY = 1;
	const READY = 2;
	const MANDATORY = 3;
	const DISCARDED = 4;

}