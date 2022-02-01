<?php
declare(strict_types=1);

namespace App\Models\DataSource\Form;

use App\Models\Repository\Table\CourseLevelRepository;
use App\Types\DB\Tables\TDbCourse;
use App\Types\DB\Tables\TDbCourseLevel;
use App\Types\Form\TFormCourse;
use App\Types\Form\TFormCourseLevel;
use Exception;

class CourseLevelFormDataSource {

	/** @var CourseLevelRepository @inject @internal */
	public $courseLevelRepo;

	public function getDefaultsSelectCourseLevel($familyId): TFormCourseLevel {
		/** @var TDbCourseLevel $courseLevel */
		$courseLevel = $this->courseLevelRepo->fetchById($familyId);

		$values = new TFormCourseLevel();
		$values->id = $courseLevel->id;
		$values->name = $courseLevel->name;
		$values->abbreviation = $courseLevel->abbreviation;
		$values->description = $courseLevel->description;
		$values->note = $courseLevel->note;
		return $values;
	}

	public function save(TFormCourseLevel $values) {
		$courseLevel = new TDbCourseLevel();
		$courseLevel->id = $values->id;
		$courseLevel->name = $values->name;
		$courseLevel->abbreviation = $values->abbreviation;
		$courseLevel->description = $values->description;
		$courseLevel->note = $values->note;

		return $this->courseLevelRepo->save($courseLevel);
	}

}

class CourseLevelException extends Exception {

}