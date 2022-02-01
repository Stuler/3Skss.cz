<?php
declare(strict_types=1);

namespace App\Components\UserDetail;

use Nette\DI\Container;

class UserDetailFactory {
	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): UserDetail {
		return $this->container->createService("userDetail");
	}
}