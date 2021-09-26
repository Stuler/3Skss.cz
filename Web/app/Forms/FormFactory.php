<?php
declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\SmartObject;
use Tomaj\Form\Renderer\BootstrapVerticalRenderer;

/**
 * Vytvorenie zakladneho formulara s vyuzitim Bootstrap Rendereru
 */
class FormFactory {
	use SmartObject;

	public function create(): Form {
		$form = new Form;
		$form->setRenderer(new BootstrapVerticalRenderer());
		return $form;
	}

}