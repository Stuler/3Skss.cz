<?php

use Latte\Runtime as LR;

/** source: C:\WWW\3Skss.cz\Web\app\AdminModule\Presenters/templates/Centers/default.latte */
final class Template62a777a169 extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['activeUser' => '25, 50, 79, 107', 'squad' => '19, 44, 73, 101', 'detachment' => '69'], $this->params) as $ʟ_v => $ʟ_l) {
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

<div>
	<a class="ajax" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("showModal!", ['name'=>'FormDetachment'])) /* line 5 */;
		echo '">Vytvořit odřad</a>
</div>

<div>
	<a class="ajax" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("showModal!", ['name'=>'FormSquad'])) /* line 9 */;
		echo '">Vytvořit team/kancelář</a>
</div>

<div>
	<ul>

		<div>
			<li>
				<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Command:default")) /* line 17 */;
		echo '">Velitelské středisko</a>
				<ul>
';
		$iterations = 0;
		foreach ($squads as $squad) /* line 19 */ {
			if ($squad->center_id == 1) /* line 20 */ {
				echo '							<li>
								<a class="ajax" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editSquad!", ['squadId'=>$squad->id, 'centerId' => null])) /* line 22 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($squad->name) /* line 22 */;
				echo '</a>
							</li>
							<ul>
';
				$iterations = 0;
				foreach ($activeUsers as $activeUser) /* line 25 */ {
					if (($activeUser->squad_id == $squad->id) && ($activeUser->is_super_admin == 0)) /* line 26 */ {
						echo '										<li>
											<a href="';
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:edit", ['userId'=>$activeUser->id])) /* line 28 */;
						echo '">';
						echo LR\Filters::escapeHtmlText($activeUser->nick) /* line 28 */;
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
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("TrainingCenter:default")) /* line 42 */;
		echo '">1. Středisko Speciálního Výcviku</a>
				<ul>
';
		$iterations = 0;
		foreach ($squads as $squad) /* line 44 */ {
			if ($squad->center_id == 2) /* line 45 */ {
				echo '							<li>
								<a class="ajax" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editSquad!", ['squadId'=>$squad->id, 'centerId' => null])) /* line 47 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($squad->name) /* line 47 */;
				echo '</a>
							</li>
							<ul>
';
				$iterations = 0;
				foreach ($activeUsers as $activeUser) /* line 50 */ {
					if (($activeUser->squad_id == $squad->id) && ($activeUser->is_super_admin == 0)) /* line 51 */ {
						echo '										<li>
											<a href="';
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("users:edit", ['userId'=>$activeUser->id])) /* line 53 */;
						echo '">';
						echo LR\Filters::escapeHtmlText($activeUser->nick) /* line 53 */;
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
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("CombatSection:default")) /* line 67 */;
		echo '">2. Bojové středisko</a>
				<ul>
';
		$iterations = 0;
		foreach ($detachments as $detachment) /* line 69 */ {
			if ($detachment->center_id == 3) /* line 70 */ {
				echo '							<a class="ajax" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editDetachment!", ['detachmentId'=>$detachment->id])) /* line 71 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($detachment->name) /* line 71 */;
				echo '</a>
							<ul>
';
				$iterations = 0;
				foreach ($squads as $squad) /* line 73 */ {
					if ($squad->detachment_id == $detachment->id) /* line 74 */ {
						echo '										<li>
											<a class="ajax" href="';
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editSquad!", ['squadId'=>$squad->id, 'centerId' => null])) /* line 76 */;
						echo '">';
						echo LR\Filters::escapeHtmlText($squad->name) /* line 76 */;
						echo '</a>
										</li>
										<ul>
';
						$iterations = 0;
						foreach ($activeUsers as $activeUser) /* line 79 */ {
							if (($activeUser->squad_id == $squad->id) && ($activeUser->is_super_admin == 0)) /* line 80 */ {
								echo '													<li>
														<a href="';
								echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Users:view", ['userId'=>$activeUser->id])) /* line 82 */;
								echo '">';
								echo LR\Filters::escapeHtmlText($activeUser->nick) /* line 82 */;
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

		<div>
			<li>
				<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("CombatSection:default")) /* line 98 */;
		echo '">Letecý Odřad Speciálních Operací</a>
				<ul>
					<ul>
';
		$iterations = 0;
		foreach ($squads as $squad) /* line 101 */ {
			if ($squad->center_id == 4) /* line 102 */ {
				echo '								<li>
									<a class="ajax" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editSquad!", ['squadId'=>$squad->id, 'centerId' => null])) /* line 104 */;
				echo '">';
				echo LR\Filters::escapeHtmlText($squad->name) /* line 104 */;
				echo '</a>
								</li>
								<ul>
';
				$iterations = 0;
				foreach ($activeUsers as $activeUser) /* line 107 */ {
					if (($activeUser->squad_id == $squad->id) && ($activeUser->is_super_admin == 0)) /* line 108 */ {
						echo '											<li>
												<a href="';
						echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Users:view", ['userId'=>$activeUser->id])) /* line 110 */;
						echo '">';
						echo LR\Filters::escapeHtmlText($activeUser->nick) /* line 110 */;
						echo '</a>
											</li>
';
					}
					$iterations++;
				}
				echo '								</ul>
';
			}
			$iterations++;
		}
		echo '					</ul>
				</ul>
			</li>
		</div>

	</ul>
</div>

<div id="';
		echo htmlspecialchars($this->global->snippetDriver->getHtmlId('modalFormSquad'));
		echo '">';
		$this->renderBlock('modalFormSquad', [], null, 'snippet') /* line 125 */;
		echo '</div>';
		
	}


	/** {snippet modalFormSquad} on line 125 */
	public function blockModalFormSquad(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("modalFormSquad", 'static');
		try {
			if (isset($showModal)) /* line 126 */ {
				echo '		<div class="modal-content">
			<a class="ajax float-right" href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("closeModal!")) /* line 128 */;
				echo '">X</a>
';
				if ($modalName == 'FormCenter') /* line 129 */ {
					/* line 130 */ $_tmp = $this->global->uiControl->getComponent("formCenter");
					if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
					$_tmp->render();
				} elseif ($modalName == 'FormDetachment') /* line 131 */ {
					/* line 132 */ $_tmp = $this->global->uiControl->getComponent("formDetachment");
					if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
					$_tmp->render();
				} elseif ($modalName == 'FormSquad') /* line 133 */ {
					/* line 134 */ $_tmp = $this->global->uiControl->getComponent("formSquad");
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
