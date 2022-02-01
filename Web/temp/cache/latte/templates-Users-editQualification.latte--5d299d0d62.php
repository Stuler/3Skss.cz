<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3skss-perscom/apps/web/app/AdminModule/Presenters/templates/Users/editQualification.latte */
final class Template5d299d0d62 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent'],
		'snippet' => ['form' => 'blockForm', 'modal' => 'blockModal'],
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
			foreach (array_intersect_key(['course' => '5'], $this->params) as $ʟ_v => $ʟ_l) {
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
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:edit", ['qualificationId'=>null, 'courseId'=>null])) /* line 2 */;
		echo '">Návrat na editaci člena</a></div>

<p>
';
		$iterations = 0;
		foreach ($courses as $course) /* line 5 */ {
			echo '		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editUserQualification!", ['courseId' =>$course['id']])) /* line 6 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($course['name']) /* line 6 */;
			echo '</a><br>
';
			$iterations++;
		}
		echo '</p>

<div id="';
		echo htmlspecialchars($this->global->snippetDriver->getHtmlId('form'));
		echo '">';
		$this->renderBlock('form', [], null, 'snippet') /* line 10 */;
		echo '</div>
';
	}


	/** {snippet form} on line 10 */
	public function blockForm(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("form", 'static');
		try {
			echo '	<main class="col-sm-4">
		<div class="form-group">
<div id="';
			echo htmlspecialchars($this->global->snippetDriver->getHtmlId('modal'));
			echo '">';
			$this->renderBlock('modal', [], null, 'snippet') /* line 13 */;
			echo '</div>
		</div>
	</main>
';
		}
		finally {
			$this->global->snippetDriver->leave();
		}
		
	}


	/** {snippet modal} on line 13 */
	public function blockModal(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("modal", 'static');
		try {
			if (isset($showModal)) /* line 14 */ {
				echo '					<div class="modal-content">
';
				/* line 16 */ $_tmp = $this->global->uiControl->getComponent("formUserQualification");
				if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
				$_tmp->render();
				echo '					</div>
';
			}
		}
		finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
