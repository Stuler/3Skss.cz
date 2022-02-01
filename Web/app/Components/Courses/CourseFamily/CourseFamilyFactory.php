<?php
declare(strict_types=1);

namespace App\Components\Courses\CourseFamily;

use Nette\DI\Container;

class CourseFamilyFactory {

	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): CourseFamily {
		return $this->container->createService("courseFamily");
	}
}