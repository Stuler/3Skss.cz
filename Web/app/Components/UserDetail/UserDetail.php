<?php
declare(strict_types=1);

namespace App\Components\UserDetail;

use App\Models\Repository\Table\CourseCompletedRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\models\Repository\Table\UserRepository;
use Nette\Application\UI\Control;

class UserDetail extends Control {

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var CourseCompletedRepository @inject @internal */
	public $courseCompletedRepo;

	/** @var InstructorRepository @inject @internal */
	public $instructorRepo;

	/**
	 * @persistent
	 */
	public $userId;

	public function render() {
		$id = (int)$this->userId;
		if ($id) {
			$this->template->currentUser = $this->userRepo->fetchById($id);
			$this->template->coursesCompleted = $this->courseCompletedRepo->findCoursesCompleted($id);
		}
		$this->template->instructors = $this->instructorRepo->findAllActive()
			->where('user_id', $id)
			->fetchAll();
		$this->template->isEdit = $id != null;

		$this->template->setFile(__DIR__ . "/userDetail.latte");
		$this->template->render();
	}

}