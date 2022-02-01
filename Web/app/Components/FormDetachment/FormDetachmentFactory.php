<?php
declare(strict_types=1);

namespace App\Components\FormDetachment;

use Nette\DI\Container;

class FormDetachmentFactory {
	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): FormDetachment {
		return $this->container->createService("formDetachment");
	}
}