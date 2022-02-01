<?php
declare(strict_types=1);

namespace App\Components\Courses\CourseLevel;

use App\Models\DataSource\Form\CourseLevelException;
use App\Models\DataSource\Form\CourseLevelFormDataSource;
use App\Models\Repository\Table\CourseLevelRepository;
use App\models\Repository\Table\UserRepository;
use App\Types\Form\TFormCourseLevel;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class CourseLevel extends Control {

	/** @var CourseLevelRepository @inject @internal */
	public $courseLevelRepo;

	/** @var UserRepository @inject @internal */
	public $userRepo;

	/** @var CourseLevelFormDataSource @inject @internal */
	public $courseLevelDS;

	public function render() {
		$this->template->setFile(__DIR__ . "/courseLevel.latte");
		$this->template->render();
	}

	public function createComponentFormCourseLevel(): Form {
		$form = new Form();
		$form->addHidden('id');
		$form->addText('name', 'Název úrovně');
		$form->addText('abbreviation', 'Zkratka');
		$form->addTextArea('description', 'Popis');

		$courses = $this->courseLevelRepo->findAll()->fetchPairs('id', 'name');
		$form->addCheckboxList('required_course', 'Povinné kurzy', $courses);
		$form->addCheckboxList('is_required_for', 'Povinný pro', $courses);

		$instructors = $this->userRepo->findAll()->fetchPairs('id', 'name');
		$form->addCheckboxList('instructors', 'Instruktoři', $instructors);

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

}