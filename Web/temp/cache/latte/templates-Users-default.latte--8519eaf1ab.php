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
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['member' => '23'], $this->params) as $ʟ_v => $ʟ_l) {
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
		echo '
<h2>Správa uživatelů</h2>
<div><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Admin:Dashboard:default")) /* line 4 */;
		echo '">Návrat do administrace</a>
	<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("logout")) /* line 5 */;
		echo '">Odhlásit</a></div></br>
<div><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit")) /* line 6 */;
		echo '">Vytvoření nového člena</a></div></br>

<table>
	<thead>
	<tr>
		<th colspan="5">Základní informace</th>

	</tr>
	<tr>
		<th>Nick</th>
		<th>Vstup</th>
		<th>Hodnost</th>
		<th>Četa</th>
		<th>Žlutá karta</th>
	</tr>
	</thead>
	<tbody>
';
		$iterations = 0;
		foreach ($members as $member) /* line 23 */ {
			echo '		<tr>
			<th>
				<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("view", ['userId'=>$member->id])) /* line 26 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($member->nick) /* line 26 */;
			echo '</a>
			</th>
			<th>
				';
			echo LR\Filters::escapeHtmlText(($this->filters->date)($member->date_created, '%d.%m.%Y')) /* line 29 */;
			echo '
			</th>
			<th>
				';
			echo LR\Filters::escapeHtmlText($member->rank->name) /* line 32 */;
			echo '
			</th>
			<th>
				';
			echo LR\Filters::escapeHtmlText($member->squad['name']) /* line 35 */;
			echo LR\Filters::escapeHtmlText($member->squad_pos) /* line 35 */;
			echo '
			</th>
			<th>
				';
			echo LR\Filters::escapeHtmlText($member->penalty) /* line 38 */;
			echo '
			</th>
		</tr>
';
			$iterations++;
		}
		echo '	</tbody>
</table>


';
	}

}
