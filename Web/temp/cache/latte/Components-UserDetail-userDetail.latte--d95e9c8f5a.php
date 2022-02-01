<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3Skss.cz/Web/app/Components/UserDetail/userDetail.latte */
final class Templated95e9c8f5a extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		0 => ['content' => 'blockContent'],
		'snippet' => ['userDetail' => 'blockUserDetail'],
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
			foreach (array_intersect_key(['instructor' => '41'], $this->params) as $ʟ_v => $ʟ_l) {
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
		echo '<div id="';
		echo htmlspecialchars($this->global->snippetDriver->getHtmlId('userDetail'));
		echo '">';
		$this->renderBlock('userDetail', [], null, 'snippet') /* line 2 */;
		echo '</div>




';
	}


	/** {snippet userDetail} on line 2 */
	public function blockUserDetail(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		$this->global->snippetDriver->enter("userDetail", 'static');
		try {
			echo '
	<div>
		<h2>';
			echo LR\Filters::escapeHtmlText($currentUser->rank->name) /* line 5 */;
			echo ' ';
			echo LR\Filters::escapeHtmlText($currentUser->nick) /* line 5 */;
			echo '</h2>
	</div>

	<div class="container">
		<h3>Základní informace</h3>

		<div>Datum registrace: ';
			echo LR\Filters::escapeHtmlText(($this->filters->date)($currentUser->date_created, '%d-%m-%Y')) /* line 11 */;
			echo '</div>
		<div>Discord ID: ';
			echo LR\Filters::escapeHtmlText($currentUser->discord_id) /* line 12 */;
			echo '</div>
		<div>Steam ID: ';
			echo LR\Filters::escapeHtmlText($currentUser->steam_id) /* line 13 */;
			echo '</div>
	</div>

	<div class="container">
		<h3>Bojové zařazení</h3>
';
			if ($currentUser->squad) /* line 18 */ {
				echo '			<div>Jednotka: ';
				echo LR\Filters::escapeHtmlText($currentUser->squad->detachment->name) /* line 19 */;
				echo '</div>
			<div>Pozice: ';
				echo LR\Filters::escapeHtmlText($currentUser->squad->abbreviation) /* line 20 */;
				echo '-';
				echo LR\Filters::escapeHtmlText($currentUser->squad_pos) /* line 20 */;
				echo '</div>
';
			}
			else /* line 21 */ {
				echo '			<div>Jednotka: Nepřirazeno</div>
';
			}
			echo '	</div>

	<div class="container">
		<h3>Administrativní zařazení</h3>
		<ul>

';
			if ($currentUser->is_admin) /* line 30 */ {
				echo '				<li>
					Člen velení skupiny
				</li>
';
			}
			echo "\n";
			if ($currentUser->squad_pos == 1) /* line 36 */ {
				echo '				<li>
					Velitel jednotky: ';
				echo LR\Filters::escapeHtmlText($currentUser->squad->name) /* line 38 */;
				echo '
				</li>
';
			}
			$iterations = 0;
			foreach ($instructors as $instructor) /* line 41 */ {
				if ($currentUser->id == $instructor->user_id) /* line 42 */ {
					echo '					<li>
						Instruktor: ';
					echo LR\Filters::escapeHtmlText($instructor->course->name) /* line 44 */;
					echo '
					</li>
';
				}
				$iterations++;
			}
			echo '		</ul>
	</div>

	<div class="container">
		<h3>Kvalifikace</h3>

	</div>

';
		}
		finally {
			$this->global->snippetDriver->leave();
		}
		
	}

}
