<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\Selection;

class BootcampSubjectRepository extends BaseModel {
	protected $table = 'bootcamp_subject';

	public function fetchByBootcampId(int $bootcampId): Selection {
		return $this->findAllActive()
			->where('bootcamp_id', $bootcampId);
	}
}