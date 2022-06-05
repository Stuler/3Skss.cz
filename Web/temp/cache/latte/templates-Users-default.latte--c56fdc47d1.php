<?php

use Latte\Runtime as LR;

/** source: C:\WWW\3Skss.cz\Web\app\AdminModule\Presenters/templates/Users/default.latte */
final class Templatec56fdc47d1 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent'],
		'snippet' => ['SignUpForm' => 'blockSignUpForm'],
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
			foreach (array_intersect_key(['member' => '33, 66'], $this->params) as $ʟ_v => $ʟ_l) {
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
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("createUser!")) /* line 5 */;
		echo '">Vytvoření nového člena</a></div></br>
<div id="';
		echo htmlspecialchars($this->global->snippetDriver->getHtmlId('SignUpForm'));
		echo '">';
		$this->renderBlock('SignUpForm', [], null, 'snippet') /* line 6 */;
		echo '</div>

<div class="user-list active-user-list">
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
		foreach ($activeMembers as $member) /* line 33 */ {
			if ($member->id > 2 || $member->nick != 'admin') /* line 34 */ {
				echo '				<tr>
					<th><a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("view", ['userId'=>$member->id])) /* line 36 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($member->nick) /* line 36 */;
				echo '</a></th>
					<td>';
				echo LR\Filters::escapeHtmlText(($this->filters->date)($member->date_created, 'd.m. Y')) /* line 37 */;
				echo '</td>
					<td>';
				echo LR\Filters::escapeHtmlText($member->rank->name) /* line 38 */;
				echo '</td>
					';
				if ($member->squad) /* line 39 */ {
				}
				echo '
					<td>';
				echo LR\Filters::escapeHtmlText($member->squad['abbreviation']) /* line 40 */;
				echo LR\Filters::escapeHtmlText($member->squad_pos ?? null) /* line 40 */;
				echo '</td>
					<td>';
				echo LR\Filters::escapeHtmlText($member->penalty) /* line 41 */;
				echo '</td>
				</tr>
';
			}
			$iterations++;
		}
		echo '		</tbody>
	</table>
</div>

<div class="user-list inactive-user-list">
	<h3>Aktivní zálohy</h3>
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
		foreach ($inactiveMembers as $member) /* line 66 */ {
			if ($member->id > 2 || $member->nick != 'admin') /* line 67 */ {
				echo '				<tr>
					<th><a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("view", ['userId'=>$member->id])) /* line 69 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($member->nick) /* line 69 */;
				echo '</a></th>
					<td>';
				echo LR\Filters::escapeHtmlText(($this->filters->date)($member->date_created, 'd.m. Y')) /* line 70 */;
				echo '</td>
					<td>';
				echo LR\Filters::escapeHtmlText($member->rank->name) /* line 71 */;
				echo '</td>
					';
				if ($member->squad) /* line 72 */ {
				}
				echo '
					<td>';
				echo LR\Filters::escapeHtmlText($member->squad['abbreviation']) /* line 73 */;
				echo LR\Filters::escapeHtmlText($member->squad_pos ?? null) /* line 73 */;
				echo '</td>
					<td>';
				echo LR\Filters::escapeHtmlText($member->penalty) /* line 74 */;
				echo '</td>
				</tr>
';
			}
			$iterations++;
		}
		echo '		</tbody>
	</table>
</div>


';
	}


	/** {snippet SignUpForm} on line 6 */
	public function blockSignUpForm(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("SignUpForm", 'static');
		try {
			if (isset($showModal)) /* line 7 */ {
				echo '		<div class="modal-content">
			<a class="ajax float-right" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("closeModal!")) /* line 9 */;
				echo '">X</a>
';
				if ($modalName == 'SignUpForm') /* line 10 */ {
					/* line 11 */ $_tmp = $this->global->uiControl->getComponent("signUpForm");
					if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
					$_tmp->render();
				}
				echo '		</div>
';
			}
		} finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
