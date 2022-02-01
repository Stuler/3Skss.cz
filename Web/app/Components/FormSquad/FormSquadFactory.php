<?php
declare(strict_types=1);

namespace App\Components\FormSquad;

use App\Components\CustomList\CustomList;
use Nette\DI\Container;

class FormSquadFactory {

	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): FormSquad {
		return $this->container->createService("formSquad");
	}
}