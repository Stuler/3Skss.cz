<?php
declare(strict_types=1);

namespace App\Components\Courses\CourseFamily;

use App\Models\DataSource\Form\CourseFamilyException;
use App\Models\DataSource\Form\CourseFormDataSource;
use App\Models\Repository\Table\CourseRepository;
use App\Models\Repository\Table\CourseLevelRepository;
use App\Types\Form\TFormCourse;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class CourseFamily extends Control {

	/** @var CourseFormDataSource @inject @internal */
	public $courseFormDS;

	/** @var CourseLevelRepository @inject @internal */
	public $courseLevelRepo;

	/** @var CourseRepository @inject @internal */
	public $courseFamilyRepo;

	/** @persistent */
	public $courseId;

	public function render() {

		$courseFamilyId = $this->courseId;

		if ($courseFamilyId){
			$courseFamily = $this->courseFamilyRepo->fetchById($courseFamilyId);
			$this['formCourseFamily']->setDefaults($courseFamily);
		}
		$this->template->setFile(__DIR__ . "/courseFamily.latte");
		$this->template->render();
	}

	public function createComponentFormCourseFamily(): Form {
		$form = new Form();
		$form->addHidden('id');
		$form->addText('name', 'Název výcviku');
		$form->addText('abbreviation', 'Zkratka');
		$form->addTextArea('description', 'Popis');
		$form->addText('note', 'Poznámka');
		$form->addCheckbox('is_required_for_all', 'Povinný kurz');

		$courses = $this->courseLevelRepo->findAll()->fetchPairs('id', 'name');
		$form->addCheckboxList('is_required_for', 'Povinný pro:', $courses);

		$form->addSubmit('create', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormCourse $values) {
			try {
				$id = $this->courseFormDS->save($values);
				$this->redirect('this');
			} catch (CourseFamilyException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}

	public function handleEditFamily(?int $id) {
		$course = $this->courseFamilyRepo->fetchById($this->courseId);
		$this['formCourseFamily']->setDefaults($course);
	}

}