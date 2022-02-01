<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3skss-perscom/apps/web/app/AdminModule/Presenters/templates/Events/default.latte */
final class Template136b4a17cb extends Latte\Runtime\Template
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
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['event' => '8'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Admin:Dashboard:default")) /* line 2 */;
		echo '">Návrat do administrace</a>

<h2>Kalendář akcí</h2>

<h3> Události</h3>
<ul>
';
		$iterations = 0;
		foreach ($events as $event) /* line 8 */ {
			echo '		<li>
			<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("events:edit", ['eventId'=>$event['id']])) /* line 10 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($event['name']) /* line 10 */;
			echo '</a> ';
			echo LR\Filters::escapeHtmlText($event['date_from']) /* line 10 */;
			echo '<br>
		</li>
';
			$iterations++;
		}
		echo '</ul>

<div>
	<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit")) /* line 16 */;
		echo '">Vytvořit novou událost<a>
</div>

';
	}

}
