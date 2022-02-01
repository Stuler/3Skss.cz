<?php
declare(strict_types=1);

namespace App\Components\Courses\CourseLevel;

use Nette\DI\Container;

class CourseLevelFactory {

	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): CourseLevel {
		return $this->container->createService("courseLevel");
	}
}