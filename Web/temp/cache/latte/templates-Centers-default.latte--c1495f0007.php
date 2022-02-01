<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3skss-perscom/apps/web/app/AdminModule/Presenters/templates/Centers/default.latte */
final class Templatec1495f0007 extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['activeUser' => '32, 57, 86', 'squad' => '26, 51, 80', 'detachment' => '76'], $this->params) as $ʟ_v => $ʟ_l) {
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
		echo '<p>ORBAT</p>

<div><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Admin:Dashboard:default")) /* line 4 */;
		echo '">Návrat do administrace</a>
	<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Admin:Dashboard:logout")) /* line 5 */;
		echo '">Odhlásit</a></div></br>

<div>
	<a class="ajax" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("showModal!", ['name'=>'FormDetachment'])) /* line 12 */;
		echo '">Vytvořit odřad</a>
</div>

<div>
	<a class="ajax" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("showModal!", ['name'=>'FormSquad'])) /* line 16 */;
		echo '">Vytvořit team/kancelář</a>
</div>

<div>
	<ul>

		<div>
			<li>
				<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Command:default")) /* line 24 */;
		echo '">Velitelské středisko</a>
				<ul>
';
		$iterations = 0;
		foreach ($squads as $squad) /* line 26 */ {
			if ($squad->center_id == 1) /* line 27 */ {
				echo '							<li>
								<a class="ajax" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editSquad!", ['squadId'=>$squad->id, 'centerId' => null])) /* line 29 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($squad->name) /* line 29 */;
				echo '</a>
							</li>
							<ul>
';
				$iterations = 0;
				foreach ($activeUsers as $activeUser) /* line 32 */ {
					if (($activeUser->squad_id == $squad->id) && ($activeUser->is_super_admin == 0)) /* line 33 */ {
						echo '										<li>
											<a href="';
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:edit", ['userId'=>$activeUser->id])) /* line 35 */;
						echo '">';
						echo LR\Filters::escapeHtmlText($activeUser->nick) /* line 35 */;
						echo '</a>
										</li>
';
					}
					$iterations++;
				}
				echo '							</ul>
';
			}
			$iterations++;
		}
		echo '
				</ul>
			</li>
		</div>

		<div>
			<li>
				<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("TrainingCenter:default")) /* line 49 */;
		echo '">1. Středisko Speciálního Výcviku</a>
				<ul>
';
		$iterations = 0;
		foreach ($squads as $squad) /* line 51 */ {
			if ($squad->center_id == 2) /* line 52 */ {
				echo '							<li>
								<a class="ajax" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editSquad!", ['squadId'=>$squad->id, 'centerId' => null])) /* line 54 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($squad->name) /* line 54 */;
				echo '</a>
							</li>
							<ul>
';
				$iterations = 0;
				foreach ($activeUsers as $activeUser) /* line 57 */ {
					if (($activeUser->squad_id == $squad->id) && ($activeUser->is_super_admin == 0)) /* line 58 */ {
						echo '										<li>
											<a href="';
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:edit", ['userId'=>$activeUser->id])) /* line 60 */;
						echo '">';
						echo LR\Filters::escapeHtmlText($activeUser->nick) /* line 60 */;
						echo '</a>
										</li>
';
					}
					$iterations++;
				}
				echo '							</ul>
';
			}
			$iterations++;
		}
		echo '
				</ul>
			</li>
		</div>

		<div>
			<li>
				<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("CombatSection:default")) /* line 74 */;
		echo '">2. Bojové středisko</a>
				<ul>
';
		$iterations = 0;
		foreach ($detachments as $detachment) /* line 76 */ {
			if ($detachment->center_id == 3) /* line 77 */ {
				echo '							<a class="ajax" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editDetachment!", ['detachmentId'=>$detachment->id])) /* line 78 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($detachment->name) /* line 78 */;
				echo '</a>
							<ul>
';
				$iterations = 0;
				foreach ($squads as $squad) /* line 80 */ {
					if ($squad->detachment_id == $detachment->id) /* line 81 */ {
						echo '										<li>
											<a class="ajax" href="';
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editSquad!", ['squadId'=>$squad->id, 'centerId' => null])) /* line 83 */;
						echo '">';
						echo LR\Filters::escapeHtmlText($squad->name) /* line 83 */;
						echo '</a>
										</li>
										<ul>
';
						$iterations = 0;
						foreach ($activeUsers as $activeUser) /* line 86 */ {
							if (($activeUser->squad_id == $squad->id) && ($activeUser->is_super_admin == 0)) /* line 87 */ {
								echo '													<li>
														<a href="';
								echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Users:view", ['userId'=>$activeUser->id])) /* line 89 */;
								echo '">';
								echo LR\Filters::escapeHtmlText($activeUser->nick) /* line 89 */;
								echo '</a>
													</li>
';
							}
							$iterations++;
						}
						echo '										</ul>
';
					}
					$iterations++;
				}
				echo '							</ul>
';
			}
			$iterations++;
		}
		echo '				</ul>
			</li>
		</div>

	</ul>
</div>

<div id="';
		echo htmlspecialchars($this->global->snippetDriver->getHtmlId('modalFormSquad'));
		echo '">';
		$this->renderBlock('modalFormSquad', [], null, 'snippet') /* line 106 */;
		echo '</div>';
		
	}


	/** {snippet modalFormSquad} on line 106 */
	public function blockModalFormSquad(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("modalFormSquad", 'static');
		try {
			if (isset($showModal)) /* line 107 */ {
				echo '		<div class="modal-content">
			<a class="ajax float-right" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("closeModal!")) /* line 109 */;
				echo '">X</a>
';
				if ($modalName == 'FormCenter') /* line 110 */ {
					/* line 111 */ $_tmp = $this->global->uiControl->getComponent("formCenter");
					if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
					$_tmp->render();
				}
				elseif ($modalName == 'FormDetachment') /* line 112 */ {
					/* line 113 */ $_tmp = $this->global->uiControl->getComponent("formDetachment");
					if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
					$_tmp->render();
				}
				elseif ($modalName == 'FormSquad') /* line 114 */ {
					/* line 115 */ $_tmp = $this->global->uiControl->getComponent("formSquad");
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
