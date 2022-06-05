<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

class BootcampParticipantRepository extends BaseModel {

	public const MAIN_INSTRUCTOR = 1;
	public const ASSIST_INSTRUCTOR = 2;
	public const RECRUIT = 3;

	protected $table = 'bootcamp_class_participant';

	public function findByBootcampId(?int $bootcampId): Selection {
		return $this->findAllActive()->where('bootcamp_class_id', $bootcampId);
	}

	public function findMainInstructors(int $bootcampId): Selection {
		return $this->findByBootcampId($bootcampId)
			->where('role_id', self::MAIN_INSTRUCTOR);
	}

	public function findAssistInstructors(int $bootcampId): Selection {
		return $this->findByBootcampId($bootcampId)
			->where('role_id', self::ASSIST_INSTRUCTOR);
	}

	public function findRecruits(int $bootcampId): Selection {
		return $this->findByBootcampId($bootcampId)
			->where('role_id', self::RECRUIT);
	}

	public function fetchTrainingStatusByUserId(int $bootcampId, int $userId): ?ActiveRow {
		return $this->findByBootcampId($bootcampId)
			->where('user_id ?', $userId)
			->limit(1)
			->fetch();
	}
}