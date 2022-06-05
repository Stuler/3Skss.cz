<?php
declare(strict_types=1);

namespace App\models\Repository\Table;

use App\models\BaseModel\BaseModel;

class SquadRepository extends BaseModel {

	protected $table = 'squad';

	public const IN_TRAINING = 5;
}