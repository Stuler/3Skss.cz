<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3Skss.cz/Web/app/AdminModule/Presenters/templates/Dashboard/default.latte */
final class Template1d2a402232 extends Latte\Runtime\Template
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
		echo '<p>Vítejte v administraci!</p>

';
		if ($user->isInRole('admin')) /* line 4 */ {
			echo '<p><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Users:default")) /* line 4 */;
			echo '">Správa uživatelů</a></p>
';
		}
		if ($user->isInRole('admin')) /* line 5 */ {
			echo '<p><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Teams:default")) /* line 5 */;
			echo '">ORBAT</a></p>
';
		}
		if ($user->isInRole('admin')) /* line 6 */ {
			echo '<p><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Events:default")) /* line 6 */;
			echo '">Kalendář akcí</a></p>
';
		}
		if (!$user->isInRole('admin')) /* line 7 */ {
			echo '<p>Nemáte administrátorská oprávnění, požádejte administrátora webu, aby vám je přidělil.</p>
';
		}
		echo '<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("logout")) /* line 8 */;
		echo '">Odhlásit</a>
';
	}

}
