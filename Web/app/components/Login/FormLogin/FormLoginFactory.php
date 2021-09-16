<?php
declare(strict_types=1);

namespace App\components\Login\FormLogin;

use Nette\DI\Container;

class FormLoginFactory {

	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): FormLogin {
		return $this->container->createService("formLogin");
	}
}