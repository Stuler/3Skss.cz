<?php
declare(strict_types=1);

namespace App\Models\Repository\Table;

use App\models\BaseModel\BaseModel;
use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

class CourseCompletedRepository extends BaseModel {

	protected $table = 'course_completed';

	/** @var BootcampParticipantRepository */
	public $bootcampParticipantRepo;

	/** @var BootcampSubjectRepository @inject @internal */
	public $bootcampSubjectRepo;

	public function __construct(Context                       $db,
	                            BootcampParticipantRepository $bootcampParticipantRepo,
	                            BootcampSubjectRepository     $bootcampSubjectRepo
	) {
		parent::__construct($db);
		$this->bootcampParticipantRepo = $bootcampParticipantRepo;
		$this->bootcampSubjectRepo = $bootcampSubjectRepo;
	}

	/**
	 * Returns user's completed courses
	 */
	public function fetchCoursesCompleted($userId): array {
		return $this->findAll()
			->where('user_id', $userId)
			->fetchAll();
	}

	/**
	 * Returns user's completed courses as selection
	 */
	public function findCoursesCompleted($userId): Selection {
		return $this->findAll()
			->where('user_id', $userId);
	}

	/**
	 * Returns given user specified course qualification
	 */
	public function fetchUserCourseQualification(int $userId, int $courseId): ActiveRow {
		return $this->findAll()
			->select('id, user_id, course_id, course_completition_type_id, instructor_id')
			->where('user_id ?', $userId)
			->where('course_id ?', $courseId)
			->limit(1)
			->fetch();
	}

	/**
	 * Returns qualification of users in bootcamp
	 */
	public function fetchQualificationByBootcampId(int $bootcampId): array {
		$users = $this->bootcampParticipantRepo
			->findRecruits($bootcampId)
			->fetchPairs(null, 'user_id');

		$subjects = $this->bootcampSubjectRepo
			->fetchByBootcampId($bootcampId)
			->fetchPairs(null, 'course_id');

		return $this->findAll()
			->where('user_id IN ? ', $users)
			->where('course_id IN ? ', $subjects)
			->fetchAll();
	}

	/**
	 * Returns qualification for given user and course
	 */
	public function fetchQualificationByCourseId($userId, $courseId): array {
		return $this->findAll()
			->where('user_id = ? ', $userId)
			->where('course_id = ? ', $courseId)
			->fetchAll();
	}

	/**
	 * Updates instructor data for the given course
	 */
	public function updateInstructorId($courseQualificationId, $userId): int {
		return $this->findAll()->where('id', $courseQualificationId)->update(['instructor_id' => $userId]);
	}
}