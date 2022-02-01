<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;

class SquadTypeRepository extends BaseModel {

	protected $table = 'squad_type';

	const OFFICE = 1;
	const COMBAT = 2;
	const SQUADRON = 3;
	const UNSELECTED = 4;

}