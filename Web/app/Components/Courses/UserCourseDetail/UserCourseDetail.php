<?php
declare(strict_types=1);

namespace App\Components\Courses\UserCourseDetail;

use App\Components\CustomList\CustomList;
use App\Components\CustomList\CustomListFactory;
use App\Models\DataSource\Form\UserCourseDetailFormDataSource;
use App\Models\DataSource\Form\UserCourseDetailFormException;
use App\Models\Repository\Table\CourseCompletedRepository;
use App\Models\Repository\Table\CourseCompletitionTypeRepository;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\InstructorRepository;
use App\Types\Form\TFormUserCourseDetail;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class UserCourseDetail extends Control {

	/** @var CourseRepository @inject @internal */
	public $courseRepo;

	/** @var CourseCompletitionTypeRepository @inject @internal */
	public $completitionTypeRepo;

	/** @var CourseCompletedRepository @inject @internal */
	public $courseCompletedRepo;

	/** @var UserCourseDetailFormDataSource @inject @internal */
	public $userCourseDetailFormDS;

	/** @var InstructorRepository @inject @internal */
	public $instructorRepo;

	/** @var CustomListFactory @inject @internal */
	public $customListFactory;

	/** @var array */
	public $onClick;

	/**
	 * @persistent
	 */
	public $userId;

	public $courseId;

	public function render() {
		$this->template->setFile(__DIR__ . "/userCourseDetail.latte");
		$this->template->render();
	}

	public function createComponentFormUserCourseDetail(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');
		$form->addHidden('user_id')->setDefaultValue($this->userId);
		$form->addHidden('instructor_id');
		$form->addHidden('course_id');
		$form->addText('name', 'Název kurzu')->setDisabled();

		$courses = $this->courseRepo->findAll()->fetchPairs('id', 'name');
		$courseStates = $this->completitionTypeRepo->findAll()->fetchPairs('id', 'name');
		$instructors = $this->instructorRepo->findAll()->where('course_id', $this->courseId)->fetchPairs('id', 'user_id');

		//		$inputCourse = $form->addSelect('course_id', 'Název kurzu', $courses);

		$form->addSelect('course_completition_type', 'Stav', $courseStates)->setDefaultValue(2);
		//		$form->addRadioList('instructor_id', 'Instruktor', $instructors)->setDefaultValue($this->presenter->getUser()->id);
		$form->addText('note', 'Poznámka');
		$form->addSubmit('send', 'Uložit změny');

		$form->onSuccess[] = function (Form $form, TFormUserCourseDetail $values) {
			try {
				$id = $this->userCourseDetailFormDS->save($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->redrawControl();
			} catch (UserCourseDetailFormException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function createComponentCustomListCourses(): CustomList {
		$customList = $this->customListFactory->create();
		$customList->setTable('course');
		$customList->addColumn('name', 'Název kurzu');

		$customList->onClick[] = function ($courseId) {
			$this->courseId = $courseId;
			$course = $this->courseRepo->fetchById($courseId);
			$this['formUserCourseDetail']->setDefaults($course);
			$this->redrawControl('form');
		};
		return $customList;
	}
}