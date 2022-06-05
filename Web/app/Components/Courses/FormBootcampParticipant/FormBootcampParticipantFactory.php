<?php
declare(strict_types=1);

namespace App\Components\Courses\FormBootcampParticipant;

use Nette\DI\Container;

class FormBootcampParticipantFactory {
	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): FormBootcampParticipant {
		return $this->container->createService("formBootcampParticipant");
	}
}