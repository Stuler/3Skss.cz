<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3skss-perscom/apps/web/app/AdminModule/Presenters/templates/Events/edit.latte */
final class Template059a9d5b75 extends Latte\Runtime\Template
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
		echo '
<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Admin:Events:default", ['eventId'=>null])) /* line 3 */;
		echo '">Návrat do kalendáře</a>

';
		/* line 5 */ $_tmp = $this->global->uiControl->getComponent("formEventEdit");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo "\n";
		if ($eventId) /* line 7 */ {
			echo '	<div>
		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("delete", ['id'=>$eventId])) /* line 9 */;
			echo '">Odstranit událost<a>
	</div>
';
		}
		
	}

}
