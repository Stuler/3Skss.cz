<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3Skss.cz/Web/app/AdminModule/Presenters/templates/Users/edit.latte */
final class Template6ff2f94e42 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent'],
		'snippet' => ['formUser' => 'blockFormUser', 'modalQualification' => 'blockModalQualification'],
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
			foreach (array_intersect_key(['courseCompleted' => '17'], $this->params) as $ʟ_v => $ʟ_l) {
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
		echo '<div><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:default", ['userId'=>null, 'courseId'=>null, 'qualificationId'=>null])) /* line 6 */;
		echo '">Návrat na výpis členů</a></div>
';
		if ($userId) /* line 7 */ {
			echo '	<div><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:view")) /* line 8 */;
			echo '">Návrat na detail</a></div>
';
		}
		echo '<h3>Základní informace</h3>

<div id="';
		echo htmlspecialchars($this->global->snippetDriver->getHtmlId('formUser'));
		echo '">';
		$this->renderBlock('formUser', [], null, 'snippet') /* line 12 */;
		echo '</div>

<h3>Kvalifikace</h3>
';
		$iterations = 0;
		foreach ($coursesCompleted as $courseCompleted) /* line 17 */ {
			echo '	<p>
		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editUserQualification!", ['courseId'=>$courseCompleted['course_id'], 'qualificationId'=>$courseCompleted['id']])) /* line 19 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($courseCompleted['course']['name']) /* line 19 */;
			echo '</a>
		- ';
			echo LR\Filters::escapeHtmlText(($this->filters->date)($courseCompleted['completition_date'], '%d.%m.%Y')) /* line 20 */;
			echo ' - ';
			echo LR\Filters::escapeHtmlText($courseCompleted['completition_type']['name']) /* line 20 */;
			echo ' - ';
			echo LR\Filters::escapeHtmlText($courseCompleted['instructor']['user']['nick']) /* line 20 */;
			echo '
	</p>
';
			$iterations++;
		}
		echo '
<main class="col-sm-4">
	<div class="form-group">
<div id="';
		echo htmlspecialchars($this->global->snippetDriver->getHtmlId('modalQualification'));
		echo '">';
		$this->renderBlock('modalQualification', [], null, 'snippet') /* line 26 */;
		echo '</div>
	</div>
</main>

<div><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:editQualification", ['userId' => $userId])) /* line 37 */;
		echo '">Upravit kvalifikaci</a></div>
';
		if ($userId) /* line 38 */ {
			echo '	<div><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("delete", ['id'=>$userId])) /* line 39 */;
			echo '">Smazat uživatele</a></div>
';
		}
		
	}


	/** {snippet formUser} on line 12 */
	public function blockFormUser(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("formUser", 'static');
		try {
			/* line 13 */ $_tmp = $this->global->uiControl->getComponent("formUser");
			if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
		}
		finally {
			$this->global->snippetDriver->leave();
		}
		
	}


	/** {snippet modalQualification} on line 26 */
	public function blockModalQualification(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("modalQualification", 'static');
		try {
			if (isset($showModal)) /* line 27 */ {
				echo '				<div class="modal-content">
';
				/* line 29 */ $_tmp = $this->global->uiControl->getComponent("formUserQualification");
				if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
				$_tmp->render();
				echo '					<a class="ajax float-right" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("closeModal!")) /* line 30 */;
				echo '">Zavřít</a>
				</div>
';
			}
		}
		finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
