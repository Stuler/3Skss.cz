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

	/**
	 * @param null   $backlink
	 * @param array  $additionalUrlParam
	 * @param string $linkRedirectAfterLogin
	 * @return FormLogin
	 */
	public function create($backlink = null, array $additionalUrlParam = [], string $linkRedirectAfterLogin = "Homepage:default"): FormLogin {
		return $this->container->getService("formLogin")->create($backlink, $additionalUrlParam, $linkRedirectAfterLogin);
	}
}