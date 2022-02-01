<?php
declare(strict_types=1);

namespace App\Components\SearchFilter;

use Nette\DI\Container;

class SearchFilterFactory {
	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function create(): SearchFilter {
		return $this->container->createService("searchFilter");
	}
}