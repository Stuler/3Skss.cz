<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3skss-perscom/apps/web/app/AdminModule/Presenters/templates/CombatSection/default.latte */
final class Template4ddc83dd81 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent'],
		'snippet' => ['modalFormSquad' => 'blockModalFormSquad'],
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
			foreach (array_intersect_key(['activeUser' => '39', 'squad' => '33', 'detachment' => '30'], $this->params) as $ʟ_v => $ʟ_l) {
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
<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Dashboard:default")) /* line 3 */;
		echo '">Návrat do administrace</a>
<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Centers:default")) /* line 4 */;
		echo '">Návrat do ORBAT</a>

<h2>2. Bojové středisko</h2>

<div>
	<a class="ajax" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("createDetachment!", ['centerId'=>3])) /* line 9 */;
		echo '">Vytvořit odřad</a>
</div>

<div>
	<a class="ajax" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("createSquad!", ['squadTypeId'=>2, 'centerId'=>3])) /* line 13 */;
		echo '">Vytvořit team</a>
</div>

<div id="';
		echo htmlspecialchars($this->global->snippetDriver->getHtmlId('modalFormSquad'));
		echo '">';
		$this->renderBlock('modalFormSquad', [], null, 'snippet') /* line 16 */;
		echo '</div>

<div>
';
		$iterations = 0;
		foreach ($detachments as $detachment) /* line 30 */ {
			echo '		<ul>
			<a class="ajax" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editDetachment!", ['detachmentId'=>$detachment->id])) /* line 32 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($detachment->name) /* line 32 */;
			echo '</a>
';
			$iterations = 0;
			foreach ($squads as $squad) /* line 33 */ {
				if ($squad->detachment_id == $detachment->id) /* line 34 */ {
					echo '					<li>
						<a class="ajax" href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editSquad!", ['squadId'=>$squad->id, 'centerId' => null])) /* line 36 */;
					echo '">';
					echo LR\Filters::escapeHtmlText($squad->name) /* line 36 */;
					echo '</a>
					</li>
					<ul>
';
					$iterations = 0;
					foreach ($activeUsers as $activeUser) /* line 39 */ {
						if ($activeUser->squad_id == $squad->id) /* line 40 */ {
							echo '								<li>
									<a href="';
							echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:edit", ['userId'=>$activeUser->id])) /* line 42 */;
							echo '">';
							echo LR\Filters::escapeHtmlText($activeUser->nick) /* line 42 */;
							echo '</a>
								</li>
';
						}
						$iterations++;
					}
					echo '					</ul>
';
				}
				$iterations++;
			}
			echo '		</ul>
';
			$iterations++;
		}
		echo '</div>



';
	}


	/** {snippet modalFormSquad} on line 16 */
	public function blockModalFormSquad(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("modalFormSquad", 'static');
		try {
			if (isset($showModal)) /* line 17 */ {
				echo '		<div class="modal-content">
			<a class="ajax float-right" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("closeModal!")) /* line 19 */;
				echo '">X</a>
';
				if ($modalName == 'FormDetachment') /* line 20 */ {
					/* line 21 */ $_tmp = $this->global->uiControl->getComponent("formDetachment");
					if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
					$_tmp->render();
				}
				elseif ($modalName == 'FormSquad') /* line 22 */ {
					/* line 23 */ $_tmp = $this->global->uiControl->getComponent("formSquad");
					if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
					$_tmp->render();
				}
				echo '		</div>
';
			}
		}
		finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
