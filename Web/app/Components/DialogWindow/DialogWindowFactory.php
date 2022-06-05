<?php
declare(strict_types=1);

namespace App\Components\DialogWindow;

use Nette\DI\Container;

class DialogWindowFactory {
	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): DialogWindow {
		return $this->container->createService("dialogWindow");
	}
}