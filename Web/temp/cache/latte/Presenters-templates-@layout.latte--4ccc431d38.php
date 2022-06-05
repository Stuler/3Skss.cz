<?php

use Latte\Runtime as LR;

/** source: C:\WWW\3Skss.cz\Web\app\AdminModule\Presenters/templates/@layout.latte */
final class Template4ccc431d38 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['scripts' => 'blockScripts'],
	];


	public function main(): array
	{
		extract($this->params);
		echo '<!DOCTYPE html>

<html>
<head>


	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width">
	<title>';
		if ($this->hasBlock("title")) /* line 14 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('striphtml', $ʟ_fi, $s));
			}) /* line 14 */;
			echo ' | ';
		}
		echo '[PERSCOM-3SKSS] - Administrace</title>
</head>

<body>
<div>
	<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Homepage:default")) /* line 19 */;
		echo '">Domovská stránka</a>
	<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Admin:Dashboard:default")) /* line 20 */;
		echo '">Nástěnka administrace</a>
	<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("signOut")) /* line 21 */;
		echo '">Odhlásit uživatele</a>
</div>
</br>
';
		$this->renderBlock('content', [], 'html') /* line 24 */;
		echo "\n";
		$iterations = 0;
		foreach ($flashes as $flash) /* line 26 */ {
			echo '<div';
			echo ($ʟ_tmp = array_filter(['flash', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 26 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 26 */;
			echo '</div>
';
			$iterations++;
		}
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('scripts', get_defined_vars()) /* line 27 */;
		echo '
</body>
</html>
';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['flash' => '26'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block scripts} on line 27 */
	public function blockScripts(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '<script src="';
		echo LR\Filters::escapeHtmlAttr($this->global->webpackAssetLocator->locateInPublicPath("bundle.js"));
		echo '"></script>
	<script src="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 29 */;
		echo '/js/app.js"></script>
';
	}

}
