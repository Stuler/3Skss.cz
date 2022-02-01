<?php
declare(strict_types=1);

namespace App\Components\Courses\UserCourseDetail;

use Nette\DI\Container;

class UserCourseDetailFactory {

	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): UserCourseDetail {
		return $this->container->createService("userCourseDetail");
	}
}