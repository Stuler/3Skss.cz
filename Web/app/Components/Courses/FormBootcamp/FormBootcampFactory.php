<?php
declare(strict_types=1);

namespace App\Components\Courses\FormBootcamp;

use Nette\DI\Container;

class FormBootcampFactory {
	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): FormBootcamp {
		return $this->container->createService("formBootcamp");
	}
}