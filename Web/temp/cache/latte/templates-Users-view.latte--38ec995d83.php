<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3Skss.cz/Web/app/AdminModule/Presenters/templates/Users/view.latte */
final class Template38ec995d83 extends Latte\Runtime\Template
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
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '<div><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Users:default", ['userId'=>null, 'courseId'=>null, 'qualificationId'=>null])) /* line 2 */;
		echo '">Návrat na výpis členů</a></div>
<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit", ['userId'=>$userId])) /* line 3 */;
		echo '">Upravit</a>
';
		/* line 4 */ $_tmp = $this->global->uiControl->getComponent("userDetail");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo "\n";
	}

}
