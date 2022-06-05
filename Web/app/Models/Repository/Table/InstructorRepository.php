<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

class InstructorRepository extends BaseModel {

	protected $table = 'instructor';

	public function getInstructor($instructorId): ?ActiveRow {
		$instructor = $this->db->table($this->table)->get($instructorId);
		$instructor->ref('user', 'nick');
		return $instructor;
	}

	public function findInstructorByUserId($userId, $courseId): Selection {
		return $this->findAllActive()->where('user_id=? AND course_id=?', $userId, $courseId);
	}

	public function fetchInstructorByUserId(int $id): ?ActiveRow {
		return $this->findAllActive()
			->where('user_id ?', $id)
			->select('id')
			->limit(1)
			->fetch();
	}

	public function fetchUserByInstructorId($instructorId): ?ActiveRow {
		return $this->findAll()
			->where('instructor.date_deleted IS NULL')
			->where('id', $instructorId)
			->select('user.id')
			->limit(1)
			->fetch();
	}

	public function fetchPairsForQualification(?string $courseId): array {
		return $this->findAll()
			->select('user.id, user.nick')
			->where('course_id', $courseId)
			->fetchPairs('id', 'nick');
	}

	public function saveAsInstructor($values) {
		$this->db->query("INSERT INTO `$this->table`", $values);
	}

}