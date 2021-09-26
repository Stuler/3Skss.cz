<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Forms\SignInFormFactory;
use Nette\Application\UI\Form;

class SignPresenter extends BaseAdminPresenter {

	/** @persistent */
	public $backlink = '';

	/** @var SignInFormFactory */
	private $signInFormFactory;

	public function __construct(SignInFormFactory $signInFormFactory) {
		$this->signInFormFactory = $signInFormFactory;
	}

	protected function createComponentSignInForm(): Form {
		return $this->signInFormFactory->create(function (): void {
			$this->restoreRequest($this->backlink);
			$this->redirect('Dashboard:');
		});
	}

	public function actionOut() {
		$this->getUser()->logout();
	}
}