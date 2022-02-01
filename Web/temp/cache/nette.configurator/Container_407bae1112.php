<?php
// source: /Users/anythingdev/Sites/3skss-perscom/apps/web/config/common.neon
// source: /Users/anythingdev/Sites/3skss-perscom/apps/web/config/local.neon
// source: array

/** @noinspection PhpParamsInspection,PhpMethodMayBeStaticInspection */

declare(strict_types=1);

class Container_407bae1112 extends Nette\DI\Container
{
	protected $types = ['container' => 'Nette\DI\Container'];

	protected $aliases = [
		'application' => 'application.application',
		'cacheStorage' => 'cache.storage',
		'database.default' => 'database.default.connection',
		'httpRequest' => 'http.request',
		'httpResponse' => 'http.response',
		'nette.authorizator' => 'security.authorizator',
		'nette.cacheJournal' => 'cache.journal',
		'nette.database.default' => 'database.default',
		'nette.database.default.context' => 'database.default.context',
		'nette.httpRequestFactory' => 'http.requestFactory',
		'nette.latteFactory' => 'latte.latteFactory',
		'nette.mailer' => 'mail.mailer',
		'nette.presenterFactory' => 'application.presenterFactory',
		'nette.templateFactory' => 'latte.templateFactory',
		'nette.userStorage' => 'security.userStorage',
		'session' => 'session.session',
		'user' => 'security.user',
	];

	protected $wiring = [
		'Nette\DI\Container' => [['container']],
		'Nette\Application\Application' => [['application.application']],
		'Nette\Application\IPresenterFactory' => [['application.presenterFactory']],
		'Nette\Application\LinkGenerator' => [['application.linkGenerator']],
		'Nette\Caching\Storages\Journal' => [['cache.journal']],
		'Nette\Caching\Storage' => [['cache.storage']],
		'Nette\Database\Connection' => [['database.default.connection']],
		'Nette\Database\IStructure' => [['database.default.structure']],
		'Nette\Database\Structure' => [['database.default.structure']],
		'Nette\Database\Conventions' => [['database.default.conventions']],
		'Nette\Database\Conventions\DiscoveredConventions' => [['database.default.conventions']],
		'Nette\Database\Explorer' => [['database.default.context']],
		'Nette\Http\RequestFactory' => [['http.requestFactory']],
		'Nette\Http\IRequest' => [['http.request']],
		'Nette\Http\Request' => [['http.request']],
		'Nette\Http\IResponse' => [['http.response']],
		'Nette\Http\Response' => [['http.response']],
		'Nette\Bridges\ApplicationLatte\LatteFactory' => [['latte.latteFactory']],
		'Nette\Application\UI\TemplateFactory' => [['latte.templateFactory']],
		'Nette\Bridges\ApplicationLatte\TemplateFactory' => [['latte.templateFactory']],
		'Nette\Mail\Mailer' => [['mail.mailer']],
		'Nette\Security\Passwords' => [['security.passwords']],
		'Nette\Security\UserStorage' => [['security.userStorage']],
		'Nette\Security\IUserStorage' => [['security.legacyUserStorage']],
		'Nette\Security\User' => [['security.user']],
		'Nette\Security\Authorizator' => [['security.authorizator']],
		'Nette\Http\Session' => [['session.session']],
		'Tracy\ILogger' => [['tracy.logger']],
		'Tracy\BlueScreen' => [['tracy.blueScreen']],
		'Tracy\Bar' => [['tracy.bar']],
		'Nextras\Migrations\IDbal' => [['migrations.dbal']],
		'Nextras\Migrations\IDriver' => [['migrations.driver']],
		'Nextras\Migrations\Entities\Group' => [
			2 => ['migrations.group.structures', 'migrations.group.basicData', 'migrations.group.dummyData'],
		],
		'Nextras\Migrations\IExtensionHandler' => [
			2 => ['migrations.extensionHandler.sql', 'migrations.extensionHandler.php'],
		],
		'Nextras\Migrations\Extensions\SqlHandler' => [2 => ['migrations.extensionHandler.sql']],
		'Nextras\Migrations\Extensions\PhpHandler' => [2 => ['migrations.extensionHandler.php']],
		'Nextras\Migrations\IConfiguration' => [['migrations.configuration']],
		'Nextras\Migrations\Bridges\SymfonyConsole\BaseCommand' => [
			2 => ['migrations.continueCommand', 'migrations.createCommand', 'migrations.resetCommand'],
		],
		'Symfony\Component\Console\Command\Command' => [
			2 => ['migrations.continueCommand', 'migrations.createCommand', 'migrations.resetCommand'],
		],
		'Nextras\Migrations\Bridges\SymfonyConsole\ContinueCommand' => [['migrations.continueCommand']],
		'Nextras\Migrations\Bridges\SymfonyConsole\CreateCommand' => [['migrations.createCommand']],
		'Nextras\Migrations\Bridges\SymfonyConsole\ResetCommand' => [['migrations.resetCommand']],
		'Nette\Routing\RouteList' => [['01']],
		'Nette\Routing\Router' => [['01']],
		'ArrayAccess' => [
			2 => [
				'01',
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Countable' => [2 => ['01']],
		'IteratorAggregate' => [2 => ['01']],
		'Traversable' => [2 => ['01']],
		'Nette\Application\Routers\RouteList' => [['01']],
		'App\Forms\FormFactory' => [['02']],
		'App\Forms\SignInFormFactory' => [['03']],
		'App\Forms\SignUpFormFactory' => [['04']],
		'Nette\Security\Authenticator' => [['authenticator']],
		'Nette\Security\IAuthenticator' => [['authenticator']],
		'App\models\UserManager' => [['authenticator']],
		'App\models\BaseModel\BaseModel' => [
			[
				'customRepository',
				'searchFilterRepository',
				'021',
				'022',
				'023',
				'024',
				'025',
				'026',
				'027',
				'028',
				'029',
				'030',
				'031',
				'032',
				'033',
				'034',
				'035',
				'036',
			],
		],
		'App\Components\CustomList\Models\CustomRepository' => [['customRepository']],
		'App\Components\SearchFilter\Models\SearchFilterRepository' => [['searchFilterRepository']],
		'App\Components\Courses\CourseLevel\CourseLevelFactory' => [['05']],
		'Nette\Application\UI\Control' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\Application\UI\Component' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\ComponentModel\Container' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\ComponentModel\Component' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\Application\UI\Renderable' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\ComponentModel\IContainer' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\ComponentModel\IComponent' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\Application\UI\SignalReceiver' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\Application\UI\StatePersistent' => [
			2 => [
				'courseLevel',
				'courseFamily',
				'userCourseDetail',
				'userDetail',
				'customList',
				'searchFilter',
				'formSquad',
				'formDetachment',
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'App\Components\Courses\CourseLevel\CourseLevel' => [2 => ['courseLevel']],
		'App\Components\Courses\CourseFamily\CourseFamilyFactory' => [['06']],
		'App\Components\Courses\CourseFamily\CourseFamily' => [2 => ['courseFamily']],
		'App\Components\Courses\UserCourseDetail\UserCourseDetailFactory' => [['07']],
		'App\Components\Courses\UserCourseDetail\UserCourseDetail' => [2 => ['userCourseDetail']],
		'App\Components\UserDetail\UserDetailFactory' => [['08']],
		'App\Components\UserDetail\UserDetail' => [2 => ['userDetail']],
		'App\Components\CustomList\CustomListFactory' => [['09']],
		'App\Components\CustomList\CustomList' => [2 => ['customList']],
		'App\Components\SearchFilter\SearchFilterFactory' => [['010']],
		'App\Components\SearchFilter\SearchFilter' => [2 => ['searchFilter']],
		'App\Components\FormSquad\FormSquadFactory' => [['011']],
		'App\Components\FormSquad\FormSquad' => [2 => ['formSquad']],
		'App\Components\FormDetachment\FormDetachmentFactory' => [['012']],
		'App\Components\FormDetachment\FormDetachment' => [2 => ['formDetachment']],
		'App\Presenters\_core\BasePresenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
			],
		],
		'Nette\Application\UI\Presenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
			],
		],
		'Nette\Application\IPresenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.8',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.18',
				'application.19',
				'application.20',
			],
		],
		'App\MemberModule\Presenters\MemberDashboardPresenter' => [2 => ['application.1']],
		'App\AdminModule\Presenters\CentersPresenter' => [2 => ['application.2']],
		'App\AdminModule\Presenters\AddonsPresenter' => [2 => ['application.3']],
		'App\AdminModule\Presenters\CommandPresenter' => [2 => ['application.4']],
		'App\AdminModule\Presenters\UsersPresenter' => [2 => ['application.5']],
		'App\AdminModule\Presenters\EventsPresenter' => [2 => ['application.6']],
		'App\AdminModule\Presenters\CombatSectionPresenter' => [2 => ['application.7']],
		'App\AdminModule\Presenters\TrainingCenterPresenter' => [2 => ['application.8']],
		'App\AdminModule\Presenters\ExceptionPresenter' => [2 => ['application.9']],
		'App\AdminModule\Presenters\FrameworkInstancesPresenter' => [2 => ['application.10']],
		'App\AdminModule\Presenters\DashboardPresenter' => [2 => ['application.11']],
		'App\AdminModule\Presenters\ServerManagerPresenter' => [2 => ['application.12']],
		'App\AdminModule\Presenters\TacAirPresenter' => [2 => ['application.13']],
		'App\Presenters\ErrorPresenter' => [2 => ['application.14']],
		'App\Presenters\_core\SecuredPresenter' => [2 => ['application.16']],
		'App\Presenters\HomepagePresenter' => [2 => ['application.17']],
		'App\Presenters\Error4xxPresenter' => [2 => ['application.18']],
		'NetteModule\ErrorPresenter' => [2 => ['application.19']],
		'NetteModule\MicroPresenter' => [2 => ['application.20']],
		'App\Models\DataSource\Form\CourseLevelFormDataSource' => [['013']],
		'App\Models\DataSource\Form\UserCourseDetailFormDataSource' => [['014']],
		'App\Models\DataSource\Form\CenterFormDataSource' => [['015']],
		'App\models\DataSource\Form\UserFormDataSource' => [['016']],
		'App\Models\DataSource\Form\CourseFormDataSource' => [['017']],
		'App\Models\DataSource\Form\SquadFormDataSource' => [['018']],
		'App\Models\DataSource\Form\DetachmentFormDataSource' => [['019']],
		'App\Models\DataSource\Form\EventFormDataSource' => [['020']],
		'App\Models\Repository\Table\DetachmentRepository' => [['021']],
		'App\Models\Repository\Table\EventTypeRepository' => [['022']],
		'App\Models\Repository\Table\CourseCompletedRepository' => [['023']],
		'App\Models\Repository\Table\SquadTypeRepository' => [['024']],
		'App\Models\Repository\Table\CourseRepository' => [['025']],
		'App\Models\Repository\Table\InstructorRepository' => [['026']],
		'App\models\Repository\Table\LoginRoleRepository' => [['027']],
		'App\Models\Repository\Table\CourseLevelRepository' => [['028']],
		'App\Models\Repository\Table\CenterRepository' => [['029']],
		'App\Models\Repository\Table\CourseCompletitionTypeRepository' => [['030']],
		'App\Models\Repository\Table\FrameworkInstancesRepository' => [['031']],
		'App\Models\Repository\Table\EventRepository' => [['032']],
		'App\models\Repository\Table\RankRepository' => [['033']],
		'App\models\Repository\Table\SquadRepository' => [['034']],
		'App\models\Repository\Table\UserRepository' => [['035']],
		'App\Models\Repository\Table\AddonsRepository' => [['036']],
		'App\Models\DataManager\DetachmentDataManager' => [['037']],
		'App\models\DataManager\RoleRuleDataManager' => [['038']],
		'App\Models\DataManager\SquadDataManager' => [['039']],
		'App\Models\DataManager\UsersDataManager' => [['040']],
		'App\Models\DataManager\EventsDataManager' => [['041']],
		'Nette\Forms\FormFactory' => [['forms.factory']],
	];


	public function __construct(array $params = [])
	{
		parent::__construct($params);
		$this->parameters += [];
	}


	public function createService01(): Nette\Application\Routers\RouteList
	{
		return App\Router\RouterFactory::createRouter();
	}


	public function createService02(): App\Forms\FormFactory
	{
		return new App\Forms\FormFactory;
	}


	public function createService03(): App\Forms\SignInFormFactory
	{
		return new App\Forms\SignInFormFactory($this->getService('02'), $this->getService('security.user'));
	}


	public function createService04(): App\Forms\SignUpFormFactory
	{
		return new App\Forms\SignUpFormFactory($this->getService('02'), $this->getService('authenticator'));
	}


	public function createService05(): App\Components\Courses\CourseLevel\CourseLevelFactory
	{
		return new App\Components\Courses\CourseLevel\CourseLevelFactory($this);
	}


	public function createService06(): App\Components\Courses\CourseFamily\CourseFamilyFactory
	{
		return new App\Components\Courses\CourseFamily\CourseFamilyFactory($this);
	}


	public function createService07(): App\Components\Courses\UserCourseDetail\UserCourseDetailFactory
	{
		return new App\Components\Courses\UserCourseDetail\UserCourseDetailFactory($this);
	}


	public function createService08(): App\Components\UserDetail\UserDetailFactory
	{
		return new App\Components\UserDetail\UserDetailFactory($this);
	}


	public function createService09(): App\Components\CustomList\CustomListFactory
	{
		return new App\Components\CustomList\CustomListFactory($this);
	}


	public function createService010(): App\Components\SearchFilter\SearchFilterFactory
	{
		return new App\Components\SearchFilter\SearchFilterFactory($this);
	}


	public function createService011(): App\Components\FormSquad\FormSquadFactory
	{
		return new App\Components\FormSquad\FormSquadFactory($this);
	}


	public function createService012(): App\Components\FormDetachment\FormDetachmentFactory
	{
		return new App\Components\FormDetachment\FormDetachmentFactory($this);
	}


	public function createService013(): App\Models\DataSource\Form\CourseLevelFormDataSource
	{
		return new App\Models\DataSource\Form\CourseLevelFormDataSource;
	}


	public function createService014(): App\Models\DataSource\Form\UserCourseDetailFormDataSource
	{
		return new App\Models\DataSource\Form\UserCourseDetailFormDataSource(
			$this->getService('023'),
			$this->getService('security.user'),
			$this->getService('026'),
			$this->getService('025'),
			$this->getService('030')
		);
	}


	public function createService015(): App\Models\DataSource\Form\CenterFormDataSource
	{
		return new App\Models\DataSource\Form\CenterFormDataSource($this->getService('029'), $this->getService('security.user'));
	}


	public function createService016(): App\models\DataSource\Form\UserFormDataSource
	{
		return new App\models\DataSource\Form\UserFormDataSource($this->getService('035'));
	}


	public function createService017(): App\Models\DataSource\Form\CourseFormDataSource
	{
		return new App\Models\DataSource\Form\CourseFormDataSource(
			$this->getService('025'),
			$this->getService('035'),
			$this->getService('026'),
			$this->getService('security.user')
		);
	}


	public function createService018(): App\Models\DataSource\Form\SquadFormDataSource
	{
		return new App\Models\DataSource\Form\SquadFormDataSource($this->getService('034'), $this->getService('security.user'));
	}


	public function createService019(): App\Models\DataSource\Form\DetachmentFormDataSource
	{
		return new App\Models\DataSource\Form\DetachmentFormDataSource($this->getService('021'), $this->getService('security.user'));
	}


	public function createService020(): App\Models\DataSource\Form\EventFormDataSource
	{
		return new App\Models\DataSource\Form\EventFormDataSource($this->getService('032'), $this->getService('security.user'));
	}


	public function createService021(): App\Models\Repository\Table\DetachmentRepository
	{
		return new App\Models\Repository\Table\DetachmentRepository($this->getService('database.default.context'));
	}


	public function createService022(): App\Models\Repository\Table\EventTypeRepository
	{
		return new App\Models\Repository\Table\EventTypeRepository($this->getService('database.default.context'));
	}


	public function createService023(): App\Models\Repository\Table\CourseCompletedRepository
	{
		return new App\Models\Repository\Table\CourseCompletedRepository($this->getService('database.default.context'));
	}


	public function createService024(): App\Models\Repository\Table\SquadTypeRepository
	{
		return new App\Models\Repository\Table\SquadTypeRepository($this->getService('database.default.context'));
	}


	public function createService025(): App\Models\Repository\Table\CourseRepository
	{
		return new App\Models\Repository\Table\CourseRepository($this->getService('database.default.context'));
	}


	public function createService026(): App\Models\Repository\Table\InstructorRepository
	{
		return new App\Models\Repository\Table\InstructorRepository($this->getService('database.default.context'));
	}


	public function createService027(): App\models\Repository\Table\LoginRoleRepository
	{
		return new App\models\Repository\Table\LoginRoleRepository($this->getService('database.default.context'));
	}


	public function createService028(): App\Models\Repository\Table\CourseLevelRepository
	{
		return new App\Models\Repository\Table\CourseLevelRepository($this->getService('database.default.context'));
	}


	public function createService029(): App\Models\Repository\Table\CenterRepository
	{
		return new App\Models\Repository\Table\CenterRepository($this->getService('database.default.context'));
	}


	public function createService030(): App\Models\Repository\Table\CourseCompletitionTypeRepository
	{
		return new App\Models\Repository\Table\CourseCompletitionTypeRepository($this->getService('database.default.context'));
	}


	public function createService031(): App\Models\Repository\Table\FrameworkInstancesRepository
	{
		return new App\Models\Repository\Table\FrameworkInstancesRepository($this->getService('database.default.context'));
	}


	public function createService032(): App\Models\Repository\Table\EventRepository
	{
		return new App\Models\Repository\Table\EventRepository($this->getService('database.default.context'));
	}


	public function createService033(): App\models\Repository\Table\RankRepository
	{
		return new App\models\Repository\Table\RankRepository($this->getService('database.default.context'));
	}


	public function createService034(): App\models\Repository\Table\SquadRepository
	{
		return new App\models\Repository\Table\SquadRepository($this->getService('database.default.context'));
	}


	public function createService035(): App\models\Repository\Table\UserRepository
	{
		return new App\models\Repository\Table\UserRepository($this->getService('database.default.context'));
	}


	public function createService036(): App\Models\Repository\Table\AddonsRepository
	{
		return new App\Models\Repository\Table\AddonsRepository($this->getService('database.default.context'));
	}


	public function createService037(): App\Models\DataManager\DetachmentDataManager
	{
		return new App\Models\DataManager\DetachmentDataManager($this->getService('021'), $this->getService('security.user'));
	}


	public function createService038(): App\models\DataManager\RoleRuleDataManager
	{
		return new App\models\DataManager\RoleRuleDataManager;
	}


	public function createService039(): App\Models\DataManager\SquadDataManager
	{
		return new App\Models\DataManager\SquadDataManager($this->getService('034'), $this->getService('security.user'));
	}


	public function createService040(): App\Models\DataManager\UsersDataManager
	{
		return new App\Models\DataManager\UsersDataManager($this->getService('035'), $this->getService('security.user'));
	}


	public function createService041(): App\Models\DataManager\EventsDataManager
	{
		return new App\Models\DataManager\EventsDataManager($this->getService('032'), $this->getService('security.user'));
	}


	public function createServiceApplication__1(): App\MemberModule\Presenters\MemberDashboardPresenter
	{
		$service = new App\MemberModule\Presenters\MemberDashboardPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__10(): App\AdminModule\Presenters\FrameworkInstancesPresenter
	{
		$service = new App\AdminModule\Presenters\FrameworkInstancesPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->frameworkInstancesRepo = $this->getService('031');
		$service->customListFactory = $this->getService('09');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__11(): App\AdminModule\Presenters\DashboardPresenter
	{
		$service = new App\AdminModule\Presenters\DashboardPresenter($this->getService('03'), $this->getService('04'));
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->userManager = $this->getService('authenticator');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__12(): App\AdminModule\Presenters\ServerManagerPresenter
	{
		$service = new App\AdminModule\Presenters\ServerManagerPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->frameworkInstancesRepo = $this->getService('031');
		$service->addonsRepo = $this->getService('036');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__13(): App\AdminModule\Presenters\TacAirPresenter
	{
		$service = new App\AdminModule\Presenters\TacAirPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__14(): App\Presenters\ErrorPresenter
	{
		return new App\Presenters\ErrorPresenter($this->getService('tracy.logger'));
	}


	public function createServiceApplication__15(): App\Presenters\_core\BasePresenter
	{
		$service = new App\Presenters\_core\BasePresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__16(): App\Presenters\_core\SecuredPresenter
	{
		$service = new App\Presenters\_core\SecuredPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->authenticator = $this->getService('authenticator');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__17(): App\Presenters\HomepagePresenter
	{
		$service = new App\Presenters\HomepagePresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__18(): App\Presenters\Error4xxPresenter
	{
		$service = new App\Presenters\Error4xxPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__19(): NetteModule\ErrorPresenter
	{
		return new NetteModule\ErrorPresenter($this->getService('tracy.logger'));
	}


	public function createServiceApplication__2(): App\AdminModule\Presenters\CentersPresenter
	{
		$service = new App\AdminModule\Presenters\CentersPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->userRepo = $this->getService('035');
		$service->squadRepository = $this->getService('034');
		$service->formSquadFactory = $this->getService('011');
		$service->formDetachmentFactory = $this->getService('012');
		$service->detachmentRepo = $this->getService('021');
		$service->detachmentFormDS = $this->getService('019');
		$service->centerRepo = $this->getService('029');
		$service->centerFormDS = $this->getService('015');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__20(): NetteModule\MicroPresenter
	{
		return new NetteModule\MicroPresenter($this, $this->getService('http.request'), $this->getService('01'));
	}


	public function createServiceApplication__3(): App\AdminModule\Presenters\AddonsPresenter
	{
		$service = new App\AdminModule\Presenters\AddonsPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->frameworkInstancesRepo = $this->getService('031');
		$service->customListFactory = $this->getService('09');
		$service->addonsRepo = $this->getService('036');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__4(): App\AdminModule\Presenters\CommandPresenter
	{
		$service = new App\AdminModule\Presenters\CommandPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__5(): App\AdminModule\Presenters\UsersPresenter
	{
		$service = new App\AdminModule\Presenters\UsersPresenter(
			$this->getService('035'),
			$this->getService('034'),
			$this->getService('033'),
			$this->getService('016'),
			$this->getService('027')
		);
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->usersDM = $this->getService('040');
		$service->userManager = $this->getService('authenticator');
		$service->userDetailFactory = $this->getService('08');
		$service->userCourseDetailFormDS = $this->getService('014');
		$service->userCourseDetailFactory = $this->getService('07');
		$service->instructorRepo = $this->getService('026');
		$service->customListFactory = $this->getService('09');
		$service->courseRepo = $this->getService('025');
		$service->courseCompletitionTypeRepo = $this->getService('030');
		$service->courseCompletedRepo = $this->getService('023');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__6(): App\AdminModule\Presenters\EventsPresenter
	{
		$service = new App\AdminModule\Presenters\EventsPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->userRepo = $this->getService('035');
		$service->eventsDM = $this->getService('041');
		$service->eventTypeRepo = $this->getService('022');
		$service->eventRepo = $this->getService('032');
		$service->eventFormDS = $this->getService('020');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__7(): App\AdminModule\Presenters\CombatSectionPresenter
	{
		$service = new App\AdminModule\Presenters\CombatSectionPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->userRepo = $this->getService('035');
		$service->squadRepo = $this->getService('034');
		$service->formSquadFactory = $this->getService('011');
		$service->formDetachmentFactory = $this->getService('012');
		$service->detachmentRepo = $this->getService('021');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__8(): App\AdminModule\Presenters\TrainingCenterPresenter
	{
		$service = new App\AdminModule\Presenters\TrainingCenterPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->customListFactory = $this->getService('09');
		$service->courseRepo = $this->getService('025');
		$service->courseLevelRepo = $this->getService('028');
		$service->courseLevelFactory = $this->getService('05');
		$service->courseLevelDS = $this->getService('013');
		$service->courseFormDS = $this->getService('017');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__9(): App\AdminModule\Presenters\ExceptionPresenter
	{
		$service = new App\AdminModule\Presenters\ExceptionPresenter;
		$service->injectPrimary(
			$this,
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response'),
			$this->getService('session.session'),
			$this->getService('security.user'),
			$this->getService('latte.templateFactory')
		);
		$service->injectFormFactory($this->getService('02'));
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__application(): Nette\Application\Application
	{
		$service = new Nette\Application\Application(
			$this->getService('application.presenterFactory'),
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('http.response')
		);
		$service->catchExceptions = null;
		$service->errorPresenter = 'Error';
		Nette\Bridges\ApplicationDI\ApplicationExtension::initializeBlueScreenPanel(
			$this->getService('tracy.blueScreen'),
			$service
		);
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\ApplicationTracy\RoutingPanel(
			$this->getService('01'),
			$this->getService('http.request'),
			$this->getService('application.presenterFactory')
		));
		return $service;
	}


	public function createServiceApplication__linkGenerator(): Nette\Application\LinkGenerator
	{
		return new Nette\Application\LinkGenerator(
			$this->getService('01'),
			$this->getService('http.request')->getUrl()->withoutUserInfo(),
			$this->getService('application.presenterFactory')
		);
	}


	public function createServiceApplication__presenterFactory(): Nette\Application\IPresenterFactory
	{
		$service = new Nette\Application\PresenterFactory(new Nette\Bridges\ApplicationDI\PresenterFactoryCallback(
			$this,
			5,
			'/Users/anythingdev/Sites/3skss-perscom/apps/web/temp/cache/nette.application/touch'
		));
		$service->setMapping(['*' => 'App\*Module\Presenters\*Presenter']);
		return $service;
	}


	public function createServiceAuthenticator(): App\models\UserManager
	{
		return new App\models\UserManager($this->getService('database.default.context'), $this->getService('security.passwords'));
	}


	public function createServiceCache__journal(): Nette\Caching\Storages\Journal
	{
		return new Nette\Caching\Storages\SQLiteJournal('/Users/anythingdev/Sites/3skss-perscom/apps/web/temp/cache/journal.s3db');
	}


	public function createServiceCache__storage(): Nette\Caching\Storage
	{
		return new Nette\Caching\Storages\FileStorage(
			'/Users/anythingdev/Sites/3skss-perscom/apps/web/temp/cache',
			$this->getService('cache.journal')
		);
	}


	public function createServiceContainer(): Container_407bae1112
	{
		return $this;
	}


	public function createServiceCourseFamily(): App\Components\Courses\CourseFamily\CourseFamily
	{
		$service = new App\Components\Courses\CourseFamily\CourseFamily;
		$service->courseLevelRepo = $this->getService('028');
		$service->courseFormDS = $this->getService('017');
		$service->courseFamilyRepo = $this->getService('025');
		return $service;
	}


	public function createServiceCourseLevel(): App\Components\Courses\CourseLevel\CourseLevel
	{
		$service = new App\Components\Courses\CourseLevel\CourseLevel;
		$service->userRepo = $this->getService('035');
		$service->courseLevelRepo = $this->getService('028');
		$service->courseLevelDS = $this->getService('013');
		return $service;
	}


	public function createServiceCustomList(): App\Components\CustomList\CustomList
	{
		$service = new App\Components\CustomList\CustomList;
		$service->customRepo = $this->getService('customRepository');
		return $service;
	}


	public function createServiceCustomRepository(): App\Components\CustomList\Models\CustomRepository
	{
		return new App\Components\CustomList\Models\CustomRepository($this->getService('database.default.context'));
	}


	public function createServiceDatabase__default__connection(): Nette\Database\Connection
	{
		$service = new Nette\Database\Connection('mysql:host=127.0.0.1;dbname=skss', 'root', null, []);
		Nette\Database\Helpers::initializeTracy(
			$service,
			true,
			'default',
			true,
			$this->getService('tracy.bar'),
			$this->getService('tracy.blueScreen')
		);
		return $service;
	}


	public function createServiceDatabase__default__context(): Nette\Database\Explorer
	{
		return new Nette\Database\Explorer(
			$this->getService('database.default.connection'),
			$this->getService('database.default.structure'),
			$this->getService('database.default.conventions'),
			$this->getService('cache.storage')
		);
	}


	public function createServiceDatabase__default__conventions(): Nette\Database\Conventions\DiscoveredConventions
	{
		return new Nette\Database\Conventions\DiscoveredConventions($this->getService('database.default.structure'));
	}


	public function createServiceDatabase__default__structure(): Nette\Database\Structure
	{
		return new Nette\Database\Structure($this->getService('database.default.connection'), $this->getService('cache.storage'));
	}


	public function createServiceFormDetachment(): App\Components\FormDetachment\FormDetachment
	{
		$service = new App\Components\FormDetachment\FormDetachment;
		$service->detachmentFormDS = $this->getService('019');
		$service->detachmentDM = $this->getService('037');
		$service->centerRepo = $this->getService('029');
		return $service;
	}


	public function createServiceFormSquad(): App\Components\FormSquad\FormSquad
	{
		$service = new App\Components\FormSquad\FormSquad;
		$service->squadTypeRepo = $this->getService('024');
		$service->squadRepo = $this->getService('034');
		$service->squadFormDS = $this->getService('018');
		$service->squadDM = $this->getService('039');
		$service->detachmentRepo = $this->getService('021');
		$service->centerRepo = $this->getService('029');
		return $service;
	}


	public function createServiceForms__factory(): Nette\Forms\FormFactory
	{
		return new Nette\Forms\FormFactory($this->getService('http.request'));
	}


	public function createServiceHttp__request(): Nette\Http\Request
	{
		return $this->getService('http.requestFactory')->fromGlobals();
	}


	public function createServiceHttp__requestFactory(): Nette\Http\RequestFactory
	{
		$service = new Nette\Http\RequestFactory;
		$service->setProxy([]);
		return $service;
	}


	public function createServiceHttp__response(): Nette\Http\Response
	{
		$service = new Nette\Http\Response;
		$service->cookieSecure = $this->getService('http.request')->isSecured();
		return $service;
	}


	public function createServiceLatte__latteFactory(): Nette\Bridges\ApplicationLatte\LatteFactory
	{
		return new class ($this) implements Nette\Bridges\ApplicationLatte\LatteFactory {
			private $container;


			public function __construct(Container_407bae1112 $container)
			{
				$this->container = $container;
			}


			public function create(): Latte\Engine
			{
				$service = new Latte\Engine;
				$service->setTempDirectory('/Users/anythingdev/Sites/3skss-perscom/apps/web/temp/cache/latte');
				$service->setAutoRefresh();
				$service->setContentType('html');
				Nette\Utils\Html::$xhtml = false;
				return $service;
			}
		};
	}


	public function createServiceLatte__templateFactory(): Nette\Bridges\ApplicationLatte\TemplateFactory
	{
		$service = new Nette\Bridges\ApplicationLatte\TemplateFactory(
			$this->getService('latte.latteFactory'),
			$this->getService('http.request'),
			$this->getService('security.user'),
			$this->getService('cache.storage')
		);
		Nette\Bridges\ApplicationDI\LatteExtension::initLattePanel($service, $this->getService('tracy.bar'));
		return $service;
	}


	public function createServiceMail__mailer(): Nette\Mail\Mailer
	{
		return new Nette\Mail\SendmailMailer;
	}


	public function createServiceMigrations__configuration(): Nextras\Migrations\IConfiguration
	{
		return new Nextras\Migrations\Configurations\Configuration(
			[
				$this->getService('migrations.group.structures'),
				$this->getService('migrations.group.basicData'),
				$this->getService('migrations.group.dummyData'),
			],
			[
				'sql' => $this->getService('migrations.extensionHandler.sql'),
				'php' => $this->getService('migrations.extensionHandler.php'),
			]
		);
	}


	public function createServiceMigrations__continueCommand(): Nextras\Migrations\Bridges\SymfonyConsole\ContinueCommand
	{
		return new Nextras\Migrations\Bridges\SymfonyConsole\ContinueCommand(
			$this->getService('migrations.driver'),
			$this->getService('migrations.configuration')
		);
	}


	public function createServiceMigrations__createCommand(): Nextras\Migrations\Bridges\SymfonyConsole\CreateCommand
	{
		return new Nextras\Migrations\Bridges\SymfonyConsole\CreateCommand(
			$this->getService('migrations.driver'),
			$this->getService('migrations.configuration')
		);
	}


	public function createServiceMigrations__dbal(): Nextras\Migrations\IDbal
	{
		return new Nextras\Migrations\Bridges\NetteDatabase\NetteAdapter($this->getService('database.default.connection'));
	}


	public function createServiceMigrations__driver(): Nextras\Migrations\IDriver
	{
		return new Nextras\Migrations\Drivers\MySqlDriver($this->getService('migrations.dbal'));
	}


	public function createServiceMigrations__extensionHandler__php(): Nextras\Migrations\Extensions\PhpHandler
	{
		return new Nextras\Migrations\Extensions\PhpHandler;
	}


	public function createServiceMigrations__extensionHandler__sql(): Nextras\Migrations\Extensions\SqlHandler
	{
		return new Nextras\Migrations\Extensions\SqlHandler($this->getService('migrations.driver'));
	}


	public function createServiceMigrations__group__basicData(): Nextras\Migrations\Entities\Group
	{
		$service = new Nextras\Migrations\Entities\Group;
		$service->name = 'basic-data';
		$service->enabled = true;
		$service->directory = '/Users/anythingdev/Sites/3skss-perscom/apps/web/app/migrations/basic-data';
		$service->dependencies = ['structures'];
		$service->generator = null;
		return $service;
	}


	public function createServiceMigrations__group__dummyData(): Nextras\Migrations\Entities\Group
	{
		$service = new Nextras\Migrations\Entities\Group;
		$service->name = 'dummy-data';
		$service->enabled = true;
		$service->directory = '/Users/anythingdev/Sites/3skss-perscom/apps/web/app/migrations/dummy-data';
		$service->dependencies = ['structures', 'basic-data'];
		$service->generator = null;
		return $service;
	}


	public function createServiceMigrations__group__structures(): Nextras\Migrations\Entities\Group
	{
		$service = new Nextras\Migrations\Entities\Group;
		$service->name = 'structures';
		$service->enabled = true;
		$service->directory = '/Users/anythingdev/Sites/3skss-perscom/apps/web/app/migrations/structures';
		$service->dependencies = [];
		$service->generator = null;
		return $service;
	}


	public function createServiceMigrations__resetCommand(): Nextras\Migrations\Bridges\SymfonyConsole\ResetCommand
	{
		return new Nextras\Migrations\Bridges\SymfonyConsole\ResetCommand(
			$this->getService('migrations.driver'),
			$this->getService('migrations.configuration')
		);
	}


	public function createServiceSearchFilter(): App\Components\SearchFilter\SearchFilter
	{
		$service = new App\Components\SearchFilter\SearchFilter;
		$service->searchFilterRepo = $this->getService('searchFilterRepository');
		return $service;
	}


	public function createServiceSearchFilterRepository(): App\Components\SearchFilter\Models\SearchFilterRepository
	{
		return new App\Components\SearchFilter\Models\SearchFilterRepository($this->getService('database.default.context'));
	}


	public function createServiceSecurity__authorizator(): Nette\Security\Authorizator
	{
		$service = new Nette\Security\Permission;
		$service->addRole('guest', null);
		$service->addRole('member', ['guest']);
		$service->addRole('admin', null);
		$service->addResource('Admin:Dashboard');
		$service->addResource('Admin:Command');
		$service->addResource('Admin:CombatSection');
		$service->addResource('Admin:TacAir');
		$service->addResource('Admin:Users');
		$service->addResource('Admin:Centers');
		$service->addResource('Admin:Events');
		$service->addResource('Admin:TrainingCenter');
		$service->addResource('Admin:Addons');
		$service->addResource('Admin:FrameworkInstances');
		$service->addResource('Admin:Exception');
		$service->addResource('Admin:ServerManager');
		$service->allow('admin');
		$service->allow('guest', 'Admin:Dashboard', 'login');
		$service->allow('guest', 'Admin:Dashboard', 'register');
		return $service;
	}


	public function createServiceSecurity__legacyUserStorage(): Nette\Security\IUserStorage
	{
		return new Nette\Http\UserStorage($this->getService('session.session'));
	}


	public function createServiceSecurity__passwords(): Nette\Security\Passwords
	{
		return new Nette\Security\Passwords;
	}


	public function createServiceSecurity__user(): Nette\Security\User
	{
		$service = new Nette\Security\User(
			$this->getService('security.legacyUserStorage'),
			$this->getService('authenticator'),
			$this->getService('security.authorizator'),
			$this->getService('security.userStorage')
		);
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\SecurityTracy\UserPanel($service));
		return $service;
	}


	public function createServiceSecurity__userStorage(): Nette\Security\UserStorage
	{
		return new Nette\Bridges\SecurityHttp\SessionStorage($this->getService('session.session'));
	}


	public function createServiceSession__session(): Nette\Http\Session
	{
		$service = new Nette\Http\Session($this->getService('http.request'), $this->getService('http.response'));
		$service->setExpiration('14 days');
		$service->setOptions(['cookieSamesite' => 'Lax']);
		return $service;
	}


	public function createServiceTracy__bar(): Tracy\Bar
	{
		return Tracy\Debugger::getBar();
	}


	public function createServiceTracy__blueScreen(): Tracy\BlueScreen
	{
		return Tracy\Debugger::getBlueScreen();
	}


	public function createServiceTracy__logger(): Tracy\ILogger
	{
		return Tracy\Debugger::getLogger();
	}


	public function createServiceUserCourseDetail(): App\Components\Courses\UserCourseDetail\UserCourseDetail
	{
		$service = new App\Components\Courses\UserCourseDetail\UserCourseDetail;
		$service->userCourseDetailFormDS = $this->getService('014');
		$service->instructorRepo = $this->getService('026');
		$service->customListFactory = $this->getService('09');
		$service->courseRepo = $this->getService('025');
		$service->courseCompletedRepo = $this->getService('023');
		$service->completitionTypeRepo = $this->getService('030');
		return $service;
	}


	public function createServiceUserDetail(): App\Components\UserDetail\UserDetail
	{
		$service = new App\Components\UserDetail\UserDetail;
		$service->userRepo = $this->getService('035');
		$service->instructorRepo = $this->getService('026');
		$service->courseCompletedRepo = $this->getService('023');
		return $service;
	}


	public function initialize()
	{
		// di.
		(function () {
			$this->getService('tracy.bar')->addPanel(new Nette\Bridges\DITracy\ContainerPanel($this));
		})();
		// http.
		(function () {
			$response = $this->getService('http.response');
			$response->setHeader('X-Powered-By', 'Nette Framework 3');
			$response->setHeader('Content-Type', 'text/html; charset=utf-8');
			$response->setHeader('X-Frame-Options', 'SAMEORIGIN');
			Nette\Http\Helpers::initCookie($this->getService('http.request'), $response);
		})();
		// session.
		(function () {
			$this->getService('session.session')->exists() && $this->getService('session.session')->start();
		})();
		// tracy.
		(function () {
			if (!Tracy\Debugger::isEnabled()) { return; }
			Tracy\Debugger::getLogger()->mailer = [new Tracy\Bridges\Nette\MailSender($this->getService('mail.mailer')), 'send'];
			$this->getService('session.session')->start();
			Tracy\Debugger::dispatch();
		})();
	}
}
