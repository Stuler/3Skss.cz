<?php
declare(strict_types=1);

namespace App\Components\DialogWindow;

use Nette\Application\UI\Control;

class DialogWindow extends Control {

	public $showModal = false;
	public $controlName;

	public function render() {
		$this->template->showModal = $this->showModal;
		$this->template->controlName = $this->controlName;
		$this->template->setFile(__DIR__ . "/dialogWindow.latte");
		$this->template->render();
	}

	public function show($controlName): DialogWindow {
		$this->controlName = $controlName;
		$this->redrawControl();
		return $this;
	}

	public function handleCloseModal() {
		$this->redrawControl("modal");
	}

}