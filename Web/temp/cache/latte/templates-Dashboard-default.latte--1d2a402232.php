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
		echo '<h1>Vítejte v administraci!</h1>

';
		if (!$user->isLoggedIn()) /* line 4 */ {
			echo '<p>Pro přístup do administrátorské sekce se <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Dashboard:login")) /* line 4 */;
			echo '">přihlašte</a>!</p>
';
		}
		if ($user->isInRole('admin')) /* line 5 */ {
			echo '<p><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Users:default")) /* line 5 */;
			echo '">Správa uživatelů</a></p>
';
		}
		if ($user->isInRole('admin')) /* line 6 */ {
			echo '<p><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Centers:default")) /* line 6 */;
			echo '">ORBAT</a></p>
';
		}
		if ($user->isInRole('admin')) /* line 7 */ {
			echo '<p><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Events:default")) /* line 7 */;
			echo '">Kalendář akcí</a></p>
';
		}
		if ($user->isInRole('admin')) /* line 8 */ {
			echo '<p><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("ServerManager:default")) /* line 8 */;
			echo '">Server Manager</a></p>
';
		}
		echo "\n";
		if (!$user->isInRole('admin')) /* line 10 */ {
			echo '<p>Nemáte administrátorská oprávnění, požádejte administrátora webu, aby vám je přidělil.</p>
';
		}
		if ($user->isLoggedIn()) /* line 11 */ {
			echo '<p><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("logout")) /* line 11 */;
			echo '">Odhlásit</a></p>
';
		}
		echo "\n";
	}

}
