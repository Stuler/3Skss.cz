<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Forms\SignInFormFactory;
use App\Forms\SignUpFormFactory;
use App\models\DuplicateNameException;
use App\models\UserManager;
use App\Presenters\_core\BasePresenter;
use App\Types\Form\TFormRegistration;
use App\Types\Form\TFormUser;
use Nette\Application\UI\Form;

class DashboardPresenter extends BaseAdminPresenter {

	/** @persistent */
	public $backlink = '';

	/** @var UserManager @inject @internal */
	public $userManager;

	private const PASSWORD_MIN_LENGTH = 6;

	public function __construct() {
		parent::__construct();
	}

	public function renderDefault() {
	}

	public function createComponentRegistrationForm(): Form {
		$form = new Form();
		$form->addHidden('id');
		$form->addText('nick', 'Nick (ve hře)')
			->setRequired('Prosím, uveď přezívku ve hře.')
			->getControlPrototype()
			->placeholder('Zde uveďte nick používaný ve hře');

		$form->addEmail('email', 'Emailová adresa')
			->setRequired('Prosím, uveď email.')
			->getControlPrototype()
			->placeholder('Zde uveďte svůj email');

		$contacts = $form->addContainer('contacts');
		$contacts->addText('facebook_id', 'Facebook účet')
			->placeholder('Zde uveďte ID Vašeho účtu na Facebooku (volitelné)');

		$contacts->addText('discord_id', 'Discord účet')
			->placeholder('Zde uveďte ID Vašeho účtu na Discordu (volitelné)');

		$form->addRadioList('preffered_branch_id', 'Preferované působení', [
			'ground' => 'Pozemní',
			'air'    => 'letecké',]);

		$experience = $form->addContainer('experience');
		$experience->addRadioList('Zkušenosti s Armou', 'Preferované působení', [
			'beginner' => 'Nováček – žádné zkušenosti – potřeba projití výcvikem',
			'advanced' => 'Pokročilý – nějaké zkušenosti – potřeba projití výcvikem',
			'expert'   => 'Zkušený – dostatek zkušeností – výcvik ve zrychleném režimu',
			'other'    => 'Jiné',
		]);

		$experience->addTextArea('experience_other', 'Jiné');
		$experience->addTextArea('experience_army', 'Zkušenosti s armádními postupy');

		$sources = $form->addContainer('sources');
		$contactSources = [
			'1' => 'z webu 3.SKSS',
			'2' => 'z Youtube',
			'3' => 'z Instagramu',
			'4' => 'ze Steamu',
			'5' => 'od kamaráda',
			'6' => 'z Facebooku',
		];
		$sources->addRadioList('contact_source', 'Jak jste se o nás dozvědeli?', $contactSources);
		$sources->addText('contact_friend', 'Pokud jsi zaškrtnul od kamaráda, od kterého?');

		$form->addSubmit('send', 'Odeslat formulář');

		$form->onSuccess[] = function (Form $form, TFormRegistration $values) {
		};
		return $form;
	}
}