<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Table\Selection;

class CourseCompletedRepository extends BaseModel {

	protected $table = 'course_completed';

	public function findCoursesCompleted($userId): Selection {
		return $this->findAll()->where('user_id', $userId);
	}

	public function findQualificationByCourseId($userId, $courseId): Selection {
		return $this->findAll()
			->where('user_id = ? AND course_id=? ', $userId, $courseId);
	}

	public function updateInstructorId($courseQualificationId, $userId) {
		return $this->findAll()->where('id', $courseQualificationId)->update(['instructor_id' => $userId]);
	}
}