<?php

declare(strict_types=1);

namespace App\AdminModule\Router;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

final class RouterFactory {
	use Nette\StaticClass;

	public static function createRouter(): RouteList {
		$router = new RouteList();

		$router
			->withModule('Admin')
			->withPath('admin')
			->addRoute('<presenter>/<action>', 'Dashboard:default')
			->addRoute('<presenter>/<action>', 'Sign:in');

		return $router;
	}
}
