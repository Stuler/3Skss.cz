<?php

use Latte\Runtime as LR;

/** source: C:\WWW\3Skss.cz\Web\app\Presenters/templates/@layout.latte */
final class Templatea06f5621fa extends Latte\Runtime\Template
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
	<link rel="stylesheet" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 6 */;
		echo '/css/style.css">
	<link rel="stylesheet" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 7 */;
		echo '/css/normalize.css">
	<link rel="stylesheet" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 8 */;
		echo '/css/bootstrap.css">
	<title>';
		if ($this->hasBlock("title")) /* line 9 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('striphtml', $ʟ_fi, $s));
			}) /* line 9 */;
			echo ' | ';
		}
		echo 'Nette Web</title>
</head>

<body>

';
		$this->renderBlock('content', [], 'html') /* line 14 */;
		echo '<p>Vitejte na stránke 3skss</p>
<p><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:in")) /* line 16 */;
		echo '">Přihlásit se</a></p>

</body>

';
		$iterations = 0;
		foreach ($flashes as $flash) /* line 20 */ {
			echo '<div';
			echo ($ʟ_tmp = array_filter(['flash', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 20 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 20 */;
			echo '</div>
';
			$iterations++;
		}
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('scripts', get_defined_vars()) /* line 21 */;
		echo '
</html>
';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['flash' => '20'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block scripts} on line 21 */
	public function blockScripts(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '<script src="';
		echo LR\Filters::escapeHtmlAttr($this->global->webpackAssetLocator->locateInPublicPath("bundle.js"));
		echo '"></script>
';
	}

}
