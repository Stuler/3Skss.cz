<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3skss-perscom/apps/web/app/Components/FormSquad/formSquad.latte */
final class Template3169a92d7a extends Latte\Runtime\Template
{

	public function main(): array
	{
		extract($this->params);
		echo "\n";
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $this->global->formsStack[] = $this->global->uiControl["formSquad"], []) /* line 3 */;
		echo '
	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["name"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["name"]->getControl() /* line 6 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["abbreviation"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["abbreviation"]->getControl() /* line 11 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["description"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["description"]->getControl() /* line 16 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["squad_type_id"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["squad_type_id"]->getControl() /* line 21 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["center_id"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["center_id"]->getControl() /* line 26 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["detachment_id"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["detachment_id"]->getControl() /* line 31 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["is_active"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["is_active"]->getControl() /* line 36 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["note"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["note"]->getControl() /* line 41 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["save"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["save"]->getControl() /* line 46 */;
		echo '
	</div>

';
		if ($isEdit) /* line 49 */ {
			echo '		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("deleteSquad!", ['id'=>$squadId])) /* line 50 */;
			echo '">Odstranit</a>
';
		}
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
