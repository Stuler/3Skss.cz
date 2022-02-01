<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\Courses\CourseLevel\CourseLevelFactory;
use App\Components\CustomList\CustomList;
use App\Components\CustomList\CustomListFactory;
use App\Models\DataSource\Form\CourseException;
use App\Models\DataSource\Form\CourseFormDataSource;
use App\Models\DataSource\Form\CourseLevelException;
use App\Models\DataSource\Form\CourseLevelFormDataSource;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\CourseLevelRepository;
use App\Presenters\_core\BasePresenter;
use App\Types\Form\TFormCourse;
use App\Types\Form\TFormCourseLevel;
use Nette\Application\UI\Form;

class TrainingCenterPresenter extends BasePresenter {
	/**
	 * TODO:
	 * dat adminovi instruktorske opravnenie
	 */

	/** @var CourseRepository @inject @internal */
	public $courseRepo;

	/** @var CourseFormDataSource @inject @internal */
	public $courseFormDS;

	/** @var CourseLevelRepository @inject @internal */
	public $courseLevelRepo;

	/** @var CourseLevelFactory @inject @internal */
	public $courseLevelFactory;

	/** @var CustomListFactory @inject @internal */
	public $customListFactory;

	/** @var CourseLevelFormDataSource @inject @internal */
	public $courseLevelDS;

	/**
	 * @persistent
	 */
	public $courseId;

	/**
	 * @persistent
	 */
	public $courseLevelId;

	public function renderDefault() {
		$this->template->etapes = $this->courseLevelRepo->findAll()->fetchAll();
		$this->template->courses = $this->courseRepo->findAll()->fetchAll();
	}

	public function renderEditCourse(?int $courseId) {
		$course = $this->courseRepo->fetchById($this->courseId);
		$this['formCourse']->setDefaults($course);
	}

	public function renderEditCourseLevel(?int $courseLevelId) {
		$courseLevel = $this->courseLevelRepo->fetchById($this->courseLevelId);
		$this['formCourseLevel']->setDefaults($courseLevel);
	}

	public function createComponentFormCourseLevel(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');
		$form->addText('name', 'Název etapy');
		$form->addText('abbreviation', 'Zkratka');
		$form->addTextArea('description', 'Popis');
		$form->addText('note', 'Poznámka');
		$form->addSubmit('create', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormCourseLevel $values) {
			try {
				$id = $this->courseLevelDS->save($values);
				$this->redirect('this');
			} catch (CourseLevelException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function createComponentFormCourse(): Form {
		$form = new Form();
		$form->getElementPrototype()->class("ajax");
		$form->addHidden('id');
		$form->addText('name', 'Název výcviku');
		$form->addText('abbreviation', 'Zkratka');
		$form->addTextArea('description', 'Popis');
		$form->addText('note', 'Poznámka');

		$courseEtapes = $this->courseLevelRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('course_level_id', 'Povinný pro:', $courseEtapes);

		$form->addSubmit('create', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormCourse $values) {
			try {
				$id = $this->courseFormDS->save($values);
				$this->redirect('this');
			} catch (CourseException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function createComponentCustomList(): CustomList {
		$customList = $this->customListFactory->create();
		$customList->setTable('course_level');
		$customList->addColumn('name', 'Název kurzu');

		$customList->onClick[] = function ($id) {
			$this->courseLevelId = $id;
			$course = $this->courseLevelRepo->fetchById($id);
			$this['formCourseLevel']->setDefaults($course);
			$this->redirect('editCourseLevel');
		};
		return $customList;
	}

	public function handleShowModal() {
		$this->template->showModal = true;
		$this->redrawControl('modal');
	}

	public function handleCloseModal() {
		$this->redrawControl("modal");
	}
}