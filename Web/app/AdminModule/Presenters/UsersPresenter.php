<?php
declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\models\DataSource\Form\UserException;
use App\models\DataSource\Form\UserFormDataSource;
use App\models\Repository\Table\RankRepository;
use App\models\Repository\Table\RoleRepository;
use App\models\Repository\Table\SquadRepository;
use App\models\Repository\Table\UserRepository;
use App\Presenters\_core\BasePresenter;
use App\Types\Form\TFormUser;
use Nette\Application\UI\Form;

/**
 * Základní presenter pro správu uživatelů
 * Možnosti:
 * 1. výpis členů
 * 2. upravit člena
 * 3. smazat člena
 */
class UsersPresenter extends BasePresenter {

	/** @var UserRepository */
	private $userRepo;

	/** @var SquadRepository */
	private $squadRepo;

	/** @var RankRepository */
	private $rankRepo;

	/** @var UserFormDataSource */
	private $userFormDS;

	/** @var RoleRepository */
	private $roleRepo;

	public function __construct(UserRepository $userRepo, SquadRepository $squadRepo, RankRepository $rankRepo, UserFormDataSource $userFormDS, RoleRepository $roleRepo) {
		$this->userRepo = $userRepo;
		$this->squadRepo = $squadRepo;
		$this->rankRepo = $rankRepo;
		$this->userFormDS = $userFormDS;
		$this->roleRepo = $roleRepo;
	}

	public function renderDefault() {
		$this->template->users = $this->userRepo->findAll()->fetchAll();
	}

	/**
	 * Základní formulář pro úpravu člena
	 */
	public function createComponentFormUser(): Form {
		$form = new Form();

		$form->addHidden('id');
		$form->addText('nick', 'Nick')->setRequired();
		$form->addText('date_created', 'Členem od')->setRequired();

		$roles = $this->roleRepo->fetchPairs('id', 'name');
		$form->addSelect('role', 'Oprávnění', $roles);

		$rank = $this->rankRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('rank_id', 'Hodnost', $rank);

		$squad = $this->squadRepo->findAll()->fetchPairs('id', 'name');
		$form->addSelect('squad_id', 'Četa', $squad);

		$form->addInteger('tactical_points', 'Taktické body');
		$form->addInteger('penalty', 'Žlutá karta');

		$choices = ['ano', 'ne', 'probíhá'];
		$form->addCheckbox('is_active', 'Aktivní', $choices);
		$form->addSelect('is_basic_infantry', 'KZP', $choices);
		$form->addSelect('is_advanced_tactics', 'DIV', $choices);
		$form->addSelect('is_medic_shooter', 'Medic/Střelec', $choices);
		$form->addSelect('is_cls', 'CLS', $choices);
		$form->addSelect('is_doctor', 'Doktor', $choices);
		$form->addSelect('is_rto_1_cz', 'RTO 1 CZ', $choices);
		$form->addSelect('is_rto_2_cz', 'RTO 2 CZ', $choices);
		$form->addSelect('is_rto_1_en', 'RTO 1 EN', $choices);
		$form->addSelect('is_rto_2_en', 'RTO 2 EN', $choices);
		$form->addSelect('is_heli_1', 'Heli 1', $choices);
		$form->addSelect('is_heli_2', 'Heli 2', $choices);
		$form->addSelect('is_heli_3', 'Heli 3', $choices);
		$form->addSelect('is_jet_1', 'Jet 1', $choices);
		$form->addSelect('is_jet_2', 'Jet 2', $choices);
		$form->addSelect('is_jet_3', 'Jet 3', $choices);
		$form->addSelect('is_engineer_basic', 'Ženista - základ', $choices);
		$form->addSelect('is_engineer_adv', 'Ženista - pokročilý', $choices);
		$form->addSelect('is_sniper', 'Ostřelovač', $choices);
		$form->addSelect('is_jtac_basic', 'JTAC - základ', $choices);
		$form->addSelect('is_jtac_adv', 'JTAC - Pokročilý', $choices);
		$form->addSelect('is_driver', 'Obrněnci + vozidla', $choices);

		$form->addTextArea('note', 'Poznámka');

		$form->addSubmit('send', 'Uložit');

		$form->onSuccess[] = function (Form $form, TFormUser $values) {
			try {
				$id = $this->userFormDS->save($values);
				$this->flashMessage('Změny byly provedeny.', 'ok');
				$this->flashMessage('Pracovní výkaz zastaven.', 'ok');
				$this->redirect('this');
			} catch (UserException $e) {
				$this->flashMessage($e->getMessage(), 'err');
			}
		};
		return $form;
	}
}