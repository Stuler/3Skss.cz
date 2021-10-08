<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3Skss.cz/Web/app/AdminModule/Presenters/templates/Users/default.latte */
final class Template8519eaf1ab extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent'],
	];


	public function main(): array
	{
		extract($this->params);
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		echo '<p>Vítejte ve správě uživatelů!</p>';
	}

}
