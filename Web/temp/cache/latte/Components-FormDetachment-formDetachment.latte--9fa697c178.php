<?php

use Latte\Runtime as LR;

/** source: /Users/anythingdev/Sites/3skss-perscom/apps/web/app/Components/FormDetachment/formDetachment.latte */
final class Template9fa697c178 extends Latte\Runtime\Template
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
		echo "\n";
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $this->global->formsStack[] = $this->global->uiControl["formDetachment"], []) /* line 3 */;
		echo '

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["name"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["name"]->getControl() /* line 7 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["abbreviation"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["abbreviation"]->getControl() /* line 12 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["description"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["description"]->getControl() /* line 17 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["center_id"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["center_id"]->getControl() /* line 22 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["is_active"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["is_active"]->getControl() /* line 27 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["note"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["note"]->getControl() /* line 32 */;
		echo '
	</div>

	<div>
		';
		if ($ʟ_label = end($this->global->formsStack)["save"]->getLabel()) echo $ʟ_label;
		echo '
		';
		echo end($this->global->formsStack)["save"]->getControl() /* line 37 */;
		echo '
	</div>

';
		if ($isEdit) /* line 40 */ {
			echo '		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("deleteDetachment!", ['id'=>$detachmentId])) /* line 41 */;
			echo '">Odstranit</a>
';
		}
		echo "\n";
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
		
	}

}
