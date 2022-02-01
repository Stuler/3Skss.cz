<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;

class CenterRepository extends BaseModel {

	protected $table = 'center';

	const COMMAND = 1;
	const TRAINING_CENTER = 2;
	const COMBAT_SECTION = 3;
	const TAC_AIR = 4;

}