<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3Skss.cz/Web/app/MemberModule/Presenters/templates/Homepage/default.latte */
final class Template0d793d6d44 extends Latte\Runtime\Template
{

	public function main(): array
	{
		extract($this->params);
		/* line 1 */ $_tmp = $this->global->uiControl->getComponent("formLogin");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
