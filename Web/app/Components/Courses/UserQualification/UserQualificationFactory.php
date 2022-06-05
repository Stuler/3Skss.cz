<?php
declare(strict_types=1);

namespace App\Components\Courses\UserQualification;

use Nette\DI\Container;

class UserQualificationFactory {

	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): UserQualification {
		return $this->container->createService("userQualification");
	}
}