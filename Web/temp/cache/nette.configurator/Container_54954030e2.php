<?php
// source: C:\WWW\3Skss.cz\Web/config/common.neon
// source: C:\WWW\3Skss.cz\Web/config/local.neon
// source: array

/** @noinspection PhpParamsInspection,PhpMethodMayBeStaticInspection */

declare(strict_types=1);

class Container_54954030e2 extends Nette\DI\Container
{
	protected $types = ['container' => 'Nette\DI\Container'];

	protected $aliases = [
		'application' => 'application.application',
		'cacheStorage' => 'cache.storage',
		'database.default' => 'database.default.connection',
		'database.default.context' => 'database.default.explorer',
		'httpRequest' => 'http.request',
		'httpResponse' => 'http.response',
		'nette.authorizator' => 'security.authorizator',
		'nette.database.default' => 'database.default',
		'nette.database.default.context' => 'database.default.explorer',
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
		'Nette\Caching\Storage' => [['cache.storage']],
		'Nette\Database\Connection' => [['database.default.connection']],
		'Nette\Database\IStructure' => [['database.default.structure']],
		'Nette\Database\Structure' => [['database.default.structure']],
		'Nette\Database\Conventions' => [['database.default.conventions']],
		'Nette\Database\Conventions\DiscoveredConventions' => [['database.default.conventions']],
		'Nette\Database\Explorer' => [['database.default.explorer']],
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
		'Oops\WebpackNetteAdapter\BasePath\BasePathProvider' => [2 => ['webpack.pathProvider.basePathProvider']],
		'Oops\WebpackNetteAdapter\PublicPathProvider' => [['webpack.pathProvider']],
		'Oops\WebpackNetteAdapter\BuildDirectoryProvider' => [['webpack.buildDirProvider']],
		'Oops\WebpackNetteAdapter\DevServer' => [['webpack.devServer']],
		'Oops\WebpackNetteAdapter\AssetLocator' => [['webpack.assetLocator']],
		'Oops\WebpackNetteAdapter\AssetNameResolver\AssetNameResolverInterface' => [
			0 => ['webpack.assetResolver.debug'],
			2 => ['webpack.assetResolver'],
		],
		'Oops\WebpackNetteAdapter\AssetNameResolver\DebuggerAwareAssetNameResolver' => [['webpack.assetResolver.debug']],
		'Nette\Routing\RouteList' => [['01']],
		'Nette\Routing\Router' => [['01']],
		'ArrayAccess' => [
			2 => [
				'01',
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
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
		'App\Models\UserManager' => [['authenticator']],
		'App\models\BaseModel\BaseModel' => [
			[
				'customRepository',
				'searchFilterRepository',
				'041',
				'042',
				'043',
				'044',
				'045',
				'046',
				'047',
				'048',
				'049',
				'050',
				'051',
				'052',
				'053',
				'054',
				'055',
				'056',
				'057',
				'058',
				'059',
				'060',
				'061',
				'062',
			],
		],
		'App\Components\CustomList\Models\CustomRepository' => [['customRepository']],
		'App\Components\SearchFilter\Models\SearchFilterRepository' => [['searchFilterRepository']],
		'App\Components\Courses\CourseLevel\CourseLevelFactory' => [['05']],
		'Nette\Application\UI\Control' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'Nette\Application\UI\Component' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'Nette\ComponentModel\Container' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'Nette\ComponentModel\Component' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'Nette\Application\UI\Renderable' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'Nette\ComponentModel\IContainer' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'Nette\ComponentModel\IComponent' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'Nette\Application\UI\SignalReceiver' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'Nette\Application\UI\StatePersistent' => [
			2 => [
				'courseLevel',
				'formBootcamp',
				'formBootcampParticipant',
				'courseFamily',
				'userQualification',
				'userDetail',
				'dialogWindow',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
			],
		],
		'App\Components\Courses\CourseLevel\CourseLevel' => [2 => ['courseLevel']],
		'App\Components\Courses\FormBootcamp\FormBootcampFactory' => [['06']],
		'App\Components\Courses\FormBootcamp\FormBootcamp' => [2 => ['formBootcamp']],
		'App\Components\Courses\FormBootcampParticipant\FormBootcampParticipantFactory' => [['07']],
		'App\Components\Courses\FormBootcampParticipant\FormBootcampParticipant' => [2 => ['formBootcampParticipant']],
		'App\Components\Courses\CourseFamily\CourseFamilyFactory' => [['08']],
		'App\Components\Courses\CourseFamily\CourseFamily' => [2 => ['courseFamily']],
		'App\Components\Courses\UserQualification\UserQualificationFactory' => [['09']],
		'App\Components\Courses\UserQualification\UserQualification' => [2 => ['userQualification']],
		'App\Components\UserDetail\UserDetailFactory' => [['010']],
		'App\Components\UserDetail\UserDetail' => [2 => ['userDetail']],
		'App\Components\DialogWindow\DialogWindowFactory' => [['011']],
		'App\Components\DialogWindow\DialogWindow' => [2 => ['dialogWindow']],
		'App\Components\CustomList\CustomListFactory' => [['012']],
		'App\Components\CustomList\CustomList' => [2 => ['customList']],
		'App\Components\SearchFilter\SearchFilterFactory' => [['013']],
		'App\Components\SearchFilter\SearchFilter' => [2 => ['searchFilter']],
		'App\Components\FormSquad\FormSquadFactory' => [['014']],
		'App\Components\FormSquad\FormSquad' => [2 => ['formSquad']],
		'App\Components\FormDetachment\FormDetachmentFactory' => [['015']],
		'App\Components\FormDetachment\FormDetachment' => [2 => ['formDetachment']],
		'App\AdminModule\Presenters\BaseAdminPresenter' => [
			2 => [
				'application.1',
				'application.2',
				'application.3',
				'application.4',
				'application.5',
				'application.6',
				'application.7',
				'application.9',
				'application.10',
				'application.11',
				'application.12',
				'application.13',
			],
		],
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
				'application.14',
				'application.15',
				'application.16',
				'application.20',
				'application.21',
				'application.22',
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
				'application.14',
				'application.15',
				'application.16',
				'application.17',
				'application.19',
				'application.20',
				'application.21',
				'application.22',
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
				'application.21',
				'application.22',
				'application.23',
				'application.24',
			],
		],
		'App\AdminModule\Presenters\AddonsPresenter' => [2 => ['application.1']],
		'App\AdminModule\Presenters\CentersPresenter' => [2 => ['application.3']],
		'App\AdminModule\Presenters\CombatSectionPresenter' => [2 => ['application.4']],
		'App\AdminModule\Presenters\CommandPresenter' => [2 => ['application.5']],
		'App\AdminModule\Presenters\DashboardPresenter' => [2 => ['application.6']],
		'App\AdminModule\Presenters\EventsPresenter' => [2 => ['application.7']],
		'App\AdminModule\Presenters\ExceptionPresenter' => [2 => ['application.8']],
		'App\AdminModule\Presenters\FrameworkInstancesPresenter' => [2 => ['application.9']],
		'App\AdminModule\Presenters\ServerManagerPresenter' => [2 => ['application.10']],
		'App\AdminModule\Presenters\TacAirPresenter' => [2 => ['application.11']],
		'App\AdminModule\Presenters\TrainingCenterPresenter' => [2 => ['application.12']],
		'App\AdminModule\Presenters\UsersPresenter' => [2 => ['application.13']],
		'App\MemberModule\Presenters\BaseMemberPresenter' => [2 => ['application.14', 'application.15']],
		'App\MemberModule\Presenters\DashboardPresenter' => [2 => ['application.15']],
		'App\MemberModule\Presenters\UsersPresenter' => [2 => ['application.16']],
		'App\Presenters\Error4xxPresenter' => [2 => ['application.17']],
		'App\Presenters\ErrorPresenter' => [2 => ['application.18']],
		'App\Presenters\HomepagePresenter' => [2 => ['application.19']],
		'App\Presenters\SignPresenter' => [2 => ['application.20']],
		'App\Presenters\_core\SecuredPresenter' => [2 => ['application.22']],
		'NetteModule\ErrorPresenter' => [2 => ['application.23']],
		'NetteModule\MicroPresenter' => [2 => ['application.24']],
		'App\Models\DataManager\BootcampDataManager' => [['016']],
		'App\Models\DataManager\DetachmentDataManager' => [['017']],
		'App\Models\DataManager\EventsDataManager' => [['018']],
		'App\models\DataManager\RoleRuleDataManager' => [['019']],
		'App\Models\DataManager\SquadDataManager' => [['020']],
		'App\Models\DataManager\UsersDataManager' => [['021']],
		'App\Models\DataSource\Form\BootcampSubjectFormDataSource' => [['022']],
		'App\Models\DataSource\Form\CenterFormDataSource' => [['023']],
		'App\Models\DataSource\Form\CourseFormDataSource' => [['024']],
		'App\Models\DataSource\Form\CourseLevelFormDataSource' => [['025']],
		'App\Models\DataSource\Form\DetachmentFormDataSource' => [['026']],
		'App\Models\DataSource\Form\EventFormDataSource' => [['027']],
		'App\Models\DataSource\Form\FormBootcampDataSource' => [['028']],
		'App\Models\DataSource\Form\FormBootcampParticipantDataSource' => [['029']],
		'App\Models\DataSource\Form\SquadFormDataSource' => [['030']],
		'App\models\DataSource\Form\UserFormDataSource' => [['031']],
		'App\Models\DataSource\Form\UserQualificationFormDataSource' => [['032']],
		'App\Models\Process\BootcampProcess' => [['033']],
		'App\Models\Process\CourseProcess' => [['034']],
		'App\Models\Process\QualificationProcess' => [['035']],
		'App\Models\Process\UserProcess' => [['036']],
		'App\Models\ProcessManager\BootcampProcessManager' => [['037']],
		'App\Models\ProcessManager\CourseProcessManager' => [['038']],
		'App\Models\ProcessManager\QualificationProcessManager' => [['039']],
		'App\Models\ProcessManager\UserProcessManager' => [['040']],
		'App\Models\Repository\Table\AddonsRepository' => [['041']],
		'App\Models\Repository\Table\BootcampClassRepository' => [['042']],
		'App\Models\Repository\Table\BootcampClassRoleRepository' => [['043']],
		'App\Models\Repository\Table\BootcampParticipantRepository' => [['044']],
		'App\Models\Repository\Table\BootcampSubjectRepository' => [['045']],
		'App\Models\Repository\Table\CenterRepository' => [['046']],
		'App\Models\Repository\Table\CourseCompletedRepository' => [['047']],
		'App\Models\Repository\Table\CourseCompletitionTypeRepository' => [['048']],
		'App\Models\Repository\Table\CourseLevelRepository' => [['049']],
		'App\Models\Repository\Table\CourseRepository' => [['050']],
		'App\Models\Repository\Table\DetachmentRepository' => [['051']],
		'App\Models\Repository\Table\EventRepository' => [['052']],
		'App\Models\Repository\Table\EventTypeRepository' => [['053']],
		'App\Models\Repository\Table\InstructorRepository' => [['054']],
		'App\Models\Repository\Table\LoginRoleRepository' => [['055']],
		'App\models\Repository\Table\RankRepository' => [['056']],
		'App\Models\Repository\Table\ServerAgentsRepository' => [['057']],
		'App\models\Repository\Table\SquadRepository' => [['058']],
		'App\Models\Repository\Table\SquadTypeRepository' => [['059']],
		'App\Models\Repository\Table\TrainingStatusRepository' => [['060']],
		'App\models\Repository\Table\UserRepository' => [['061']],
		'App\Models\Repository\Table\UserRoleRepository' => [['062']],
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


	public function createService06(): App\Components\Courses\FormBootcamp\FormBootcampFactory
	{
		return new App\Components\Courses\FormBootcamp\FormBootcampFactory($this);
	}


	public function createService07(): App\Components\Courses\FormBootcampParticipant\FormBootcampParticipantFactory
	{
		return new App\Components\Courses\FormBootcampParticipant\FormBootcampParticipantFactory($this);
	}


	public function createService08(): App\Components\Courses\CourseFamily\CourseFamilyFactory
	{
		return new App\Components\Courses\CourseFamily\CourseFamilyFactory($this);
	}


	public function createService09(): App\Components\Courses\UserQualification\UserQualificationFactory
	{
		return new App\Components\Courses\UserQualification\UserQualificationFactory($this);
	}


	public function createService010(): App\Components\UserDetail\UserDetailFactory
	{
		return new App\Components\UserDetail\UserDetailFactory($this);
	}


	public function createService011(): App\Components\DialogWindow\DialogWindowFactory
	{
		return new App\Components\DialogWindow\DialogWindowFactory($this);
	}


	public function createService012(): App\Components\CustomList\CustomListFactory
	{
		return new App\Components\CustomList\CustomListFactory($this);
	}


	public function createService013(): App\Components\SearchFilter\SearchFilterFactory
	{
		return new App\Components\SearchFilter\SearchFilterFactory($this);
	}


	public function createService014(): App\Components\FormSquad\FormSquadFactory
	{
		return new App\Components\FormSquad\FormSquadFactory($this);
	}


	public function createService015(): App\Components\FormDetachment\FormDetachmentFactory
	{
		return new App\Components\FormDetachment\FormDetachmentFactory($this);
	}


	public function createService016(): App\Models\DataManager\BootcampDataManager
	{
		return new App\Models\DataManager\BootcampDataManager(
			$this->getService('047'),
			$this->getService('044'),
			$this->getService('045')
		);
	}


	public function createService017(): App\Models\DataManager\DetachmentDataManager
	{
		return new App\Models\DataManager\DetachmentDataManager($this->getService('051'), $this->getService('security.user'));
	}


	public function createService018(): App\Models\DataManager\EventsDataManager
	{
		return new App\Models\DataManager\EventsDataManager($this->getService('052'), $this->getService('security.user'));
	}


	public function createService019(): App\models\DataManager\RoleRuleDataManager
	{
		return new App\models\DataManager\RoleRuleDataManager;
	}


	public function createService020(): App\Models\DataManager\SquadDataManager
	{
		return new App\Models\DataManager\SquadDataManager($this->getService('058'), $this->getService('security.user'));
	}


	public function createService021(): App\Models\DataManager\UsersDataManager
	{
		return new App\Models\DataManager\UsersDataManager($this->getService('061'), $this->getService('security.user'));
	}


	public function createService022(): App\Models\DataSource\Form\BootcampSubjectFormDataSource
	{
		return new App\Models\DataSource\Form\BootcampSubjectFormDataSource(
			$this->getService('042'),
			$this->getService('037'),
			$this->getService('security.user')
		);
	}


	public function createService023(): App\Models\DataSource\Form\CenterFormDataSource
	{
		return new App\Models\DataSource\Form\CenterFormDataSource($this->getService('046'), $this->getService('security.user'));
	}


	public function createService024(): App\Models\DataSource\Form\CourseFormDataSource
	{
		return new App\Models\DataSource\Form\CourseFormDataSource(
			$this->getService('050'),
			$this->getService('061'),
			$this->getService('054'),
			$this->getService('security.user'),
			$this->getService('039'),
			$this->getService('038')
		);
	}


	public function createService025(): App\Models\DataSource\Form\CourseLevelFormDataSource
	{
		return new App\Models\DataSource\Form\CourseLevelFormDataSource;
	}


	public function createService026(): App\Models\DataSource\Form\DetachmentFormDataSource
	{
		return new App\Models\DataSource\Form\DetachmentFormDataSource($this->getService('051'), $this->getService('security.user'));
	}


	public function createService027(): App\Models\DataSource\Form\EventFormDataSource
	{
		return new App\Models\DataSource\Form\EventFormDataSource($this->getService('052'), $this->getService('security.user'));
	}


	public function createService028(): App\Models\DataSource\Form\FormBootcampDataSource
	{
		return new App\Models\DataSource\Form\FormBootcampDataSource(
			$this->getService('042'),
			$this->getService('037'),
			$this->getService('security.user'),
			$this->getService('044'),
			$this->getService('045')
		);
	}


	public function createService029(): App\Models\DataSource\Form\FormBootcampParticipantDataSource
	{
		return new App\Models\DataSource\Form\FormBootcampParticipantDataSource(
			$this->getService('037'),
			$this->getService('security.user')
		);
	}


	public function createService030(): App\Models\DataSource\Form\SquadFormDataSource
	{
		return new App\Models\DataSource\Form\SquadFormDataSource($this->getService('058'), $this->getService('security.user'));
	}


	public function createService031(): App\models\DataSource\Form\UserFormDataSource
	{
		return new App\models\DataSource\Form\UserFormDataSource($this->getService('061'), $this->getService('040'));
	}


	public function createService032(): App\Models\DataSource\Form\UserQualificationFormDataSource
	{
		return new App\Models\DataSource\Form\UserQualificationFormDataSource(
			$this->getService('047'),
			$this->getService('050'),
			$this->getService('039'),
			$this->getService('054')
		);
	}


	public function createService033(): App\Models\Process\BootcampProcess
	{
		return new App\Models\Process\BootcampProcess(
			$this->getService('042'),
			$this->getService('044'),
			$this->getService('045'),
			$this->getService('security.user')
		);
	}


	public function createService034(): App\Models\Process\CourseProcess
	{
		return new App\Models\Process\CourseProcess(
			$this->getService('050'),
			$this->getService('security.user'),
			$this->getService('039')
		);
	}


	public function createService035(): App\Models\Process\QualificationProcess
	{
		return new App\Models\Process\QualificationProcess(
			$this->getService('047'),
			$this->getService('054'),
			$this->getService('048'),
			$this->getService('050'),
			$this->getService('061'),
			$this->getService('security.user'),
			$this->getService('044')
		);
	}


	public function createService036(): App\Models\Process\UserProcess
	{
		return new App\Models\Process\UserProcess($this->getService('061'), $this->getService('050'), $this->getService('039'));
	}


	public function createService037(): App\Models\ProcessManager\BootcampProcessManager
	{
		return new App\Models\ProcessManager\BootcampProcessManager($this->getService('033'));
	}


	public function createService038(): App\Models\ProcessManager\CourseProcessManager
	{
		return new App\Models\ProcessManager\CourseProcessManager($this->getService('034'));
	}


	public function createService039(): App\Models\ProcessManager\QualificationProcessManager
	{
		return new App\Models\ProcessManager\QualificationProcessManager($this->getService('035'));
	}


	public function createService040(): App\Models\ProcessManager\UserProcessManager
	{
		return new App\Models\ProcessManager\UserProcessManager($this->getService('036'));
	}


	public function createService041(): App\Models\Repository\Table\AddonsRepository
	{
		return new App\Models\Repository\Table\AddonsRepository($this->getService('database.default.explorer'));
	}


	public function createService042(): App\Models\Repository\Table\BootcampClassRepository
	{
		return new App\Models\Repository\Table\BootcampClassRepository($this->getService('database.default.explorer'));
	}


	public function createService043(): App\Models\Repository\Table\BootcampClassRoleRepository
	{
		return new App\Models\Repository\Table\BootcampClassRoleRepository($this->getService('database.default.explorer'));
	}


	public function createService044(): App\Models\Repository\Table\BootcampParticipantRepository
	{
		return new App\Models\Repository\Table\BootcampParticipantRepository($this->getService('database.default.explorer'));
	}


	public function createService045(): App\Models\Repository\Table\BootcampSubjectRepository
	{
		return new App\Models\Repository\Table\BootcampSubjectRepository($this->getService('database.default.explorer'));
	}


	public function createService046(): App\Models\Repository\Table\CenterRepository
	{
		return new App\Models\Repository\Table\CenterRepository($this->getService('database.default.explorer'));
	}


	public function createService047(): App\Models\Repository\Table\CourseCompletedRepository
	{
		return new App\Models\Repository\Table\CourseCompletedRepository(
			$this->getService('database.default.explorer'),
			$this->getService('044'),
			$this->getService('045')
		);
	}


	public function createService048(): App\Models\Repository\Table\CourseCompletitionTypeRepository
	{
		return new App\Models\Repository\Table\CourseCompletitionTypeRepository($this->getService('database.default.explorer'));
	}


	public function createService049(): App\Models\Repository\Table\CourseLevelRepository
	{
		return new App\Models\Repository\Table\CourseLevelRepository($this->getService('database.default.explorer'));
	}


	public function createService050(): App\Models\Repository\Table\CourseRepository
	{
		return new App\Models\Repository\Table\CourseRepository($this->getService('database.default.explorer'));
	}


	public function createService051(): App\Models\Repository\Table\DetachmentRepository
	{
		return new App\Models\Repository\Table\DetachmentRepository($this->getService('database.default.explorer'));
	}


	public function createService052(): App\Models\Repository\Table\EventRepository
	{
		return new App\Models\Repository\Table\EventRepository($this->getService('database.default.explorer'));
	}


	public function createService053(): App\Models\Repository\Table\EventTypeRepository
	{
		return new App\Models\Repository\Table\EventTypeRepository($this->getService('database.default.explorer'));
	}


	public function createService054(): App\Models\Repository\Table\InstructorRepository
	{
		return new App\Models\Repository\Table\InstructorRepository($this->getService('database.default.explorer'));
	}


	public function createService055(): App\Models\Repository\Table\LoginRoleRepository
	{
		return new App\Models\Repository\Table\LoginRoleRepository($this->getService('database.default.explorer'));
	}


	public function createService056(): App\models\Repository\Table\RankRepository
	{
		return new App\models\Repository\Table\RankRepository($this->getService('database.default.explorer'));
	}


	public function createService057(): App\Models\Repository\Table\ServerAgentsRepository
	{
		return new App\Models\Repository\Table\ServerAgentsRepository($this->getService('database.default.explorer'));
	}


	public function createService058(): App\models\Repository\Table\SquadRepository
	{
		return new App\models\Repository\Table\SquadRepository($this->getService('database.default.explorer'));
	}


	public function createService059(): App\Models\Repository\Table\SquadTypeRepository
	{
		return new App\Models\Repository\Table\SquadTypeRepository($this->getService('database.default.explorer'));
	}


	public function createService060(): App\Models\Repository\Table\TrainingStatusRepository
	{
		return new App\Models\Repository\Table\TrainingStatusRepository($this->getService('database.default.explorer'));
	}


	public function createService061(): App\models\Repository\Table\UserRepository
	{
		return new App\models\Repository\Table\UserRepository($this->getService('database.default.explorer'));
	}


	public function createService062(): App\Models\Repository\Table\UserRoleRepository
	{
		return new App\Models\Repository\Table\UserRoleRepository($this->getService('database.default.explorer'));
	}


	public function createServiceApplication__1(): App\AdminModule\Presenters\AddonsPresenter
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
		$service->frameworkInstancesRepo = $this->getService('057');
		$service->customListFactory = $this->getService('012');
		$service->addonsRepo = $this->getService('041');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__10(): App\AdminModule\Presenters\ServerManagerPresenter
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
		$service->serverAgentsRepo = $this->getService('057');
		$service->linkGenerator = $this->getService('application.linkGenerator');
		$service->addonsRepo = $this->getService('041');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__11(): App\AdminModule\Presenters\TacAirPresenter
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


	public function createServiceApplication__12(): App\AdminModule\Presenters\TrainingCenterPresenter
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
		$service->trainingStatusRepo = $this->getService('060');
		$service->qualificationPM = $this->getService('039');
		$service->instructorRepo = $this->getService('054');
		$service->formBootcampParticipantFactory = $this->getService('07');
		$service->formBootcampFactory = $this->getService('06');
		$service->courseRepo = $this->getService('050');
		$service->courseLevelRepo = $this->getService('049');
		$service->courseLevelFactory = $this->getService('05');
		$service->courseLevelDS = $this->getService('025');
		$service->courseFormDS = $this->getService('024');
		$service->courseCompletitionTypeRepo = $this->getService('048');
		$service->courseCompletedRepo = $this->getService('047');
		$service->bootcampSubjectRepo = $this->getService('045');
		$service->bootcampSubjectFormDS = $this->getService('022');
		$service->bootcampParticipantRepo = $this->getService('044');
		$service->bootcampPM = $this->getService('037');
		$service->bootcampDM = $this->getService('016');
		$service->bootcampClassRepo = $this->getService('042');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__13(): App\AdminModule\Presenters\UsersPresenter
	{
		$service = new App\AdminModule\Presenters\UsersPresenter(
			$this->getService('061'),
			$this->getService('058'),
			$this->getService('056'),
			$this->getService('031'),
			$this->getService('055'),
			$this->getService('040')
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
		$service->usersDM = $this->getService('021');
		$service->userManager = $this->getService('authenticator');
		$service->userDetailFactory = $this->getService('010');
		$service->userCourseDetailFormDS = $this->getService('032');
		$service->userCourseDetailFactory = $this->getService('09');
		$service->signUpFormFactory = $this->getService('04');
		$service->instructorRepo = $this->getService('054');
		$service->customListFactory = $this->getService('012');
		$service->courseRepo = $this->getService('050');
		$service->courseCompletitionTypeRepo = $this->getService('048');
		$service->courseCompletedRepo = $this->getService('047');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__14(): App\MemberModule\Presenters\BaseMemberPresenter
	{
		$service = new App\MemberModule\Presenters\BaseMemberPresenter;
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


	public function createServiceApplication__15(): App\MemberModule\Presenters\DashboardPresenter
	{
		$service = new App\MemberModule\Presenters\DashboardPresenter;
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


	public function createServiceApplication__16(): App\MemberModule\Presenters\UsersPresenter
	{
		$service = new App\MemberModule\Presenters\UsersPresenter;
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
		$service->userRepo = $this->getService('061');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__17(): App\Presenters\Error4xxPresenter
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


	public function createServiceApplication__18(): App\Presenters\ErrorPresenter
	{
		return new App\Presenters\ErrorPresenter($this->getService('tracy.logger'));
	}


	public function createServiceApplication__19(): App\Presenters\HomepagePresenter
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


	public function createServiceApplication__2(): App\AdminModule\Presenters\BaseAdminPresenter
	{
		$service = new App\AdminModule\Presenters\BaseAdminPresenter;
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


	public function createServiceApplication__20(): App\Presenters\SignPresenter
	{
		$service = new App\Presenters\SignPresenter;
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
		$service->signInFormFactory = $this->getService('03');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__21(): App\Presenters\_core\BasePresenter
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


	public function createServiceApplication__22(): App\Presenters\_core\SecuredPresenter
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


	public function createServiceApplication__23(): NetteModule\ErrorPresenter
	{
		return new NetteModule\ErrorPresenter($this->getService('tracy.logger'));
	}


	public function createServiceApplication__24(): NetteModule\MicroPresenter
	{
		return new NetteModule\MicroPresenter($this, $this->getService('http.request'), $this->getService('01'));
	}


	public function createServiceApplication__3(): App\AdminModule\Presenters\CentersPresenter
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
		$service->userRepo = $this->getService('061');
		$service->squadRepository = $this->getService('058');
		$service->formSquadFactory = $this->getService('014');
		$service->formDetachmentFactory = $this->getService('015');
		$service->dialogWindowFactory = $this->getService('011');
		$service->detachmentRepo = $this->getService('051');
		$service->detachmentFormDS = $this->getService('026');
		$service->centerRepo = $this->getService('046');
		$service->centerFormDS = $this->getService('023');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__4(): App\AdminModule\Presenters\CombatSectionPresenter
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
		$service->userRepo = $this->getService('061');
		$service->squadRepo = $this->getService('058');
		$service->formSquadFactory = $this->getService('014');
		$service->formDetachmentFactory = $this->getService('015');
		$service->detachmentRepo = $this->getService('051');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__5(): App\AdminModule\Presenters\CommandPresenter
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


	public function createServiceApplication__6(): App\AdminModule\Presenters\DashboardPresenter
	{
		$service = new App\AdminModule\Presenters\DashboardPresenter;
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


	public function createServiceApplication__7(): App\AdminModule\Presenters\EventsPresenter
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
		$service->userRepo = $this->getService('061');
		$service->eventsDM = $this->getService('018');
		$service->eventTypeRepo = $this->getService('053');
		$service->eventRepo = $this->getService('052');
		$service->eventFormDS = $this->getService('027');
		$service->invalidLinkMode = 5;
		return $service;
	}


	public function createServiceApplication__8(): App\AdminModule\Presenters\ExceptionPresenter
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


	public function createServiceApplication__9(): App\AdminModule\Presenters\FrameworkInstancesPresenter
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
		$service->frameworkInstancesRepo = $this->getService('057');
		$service->customListFactory = $this->getService('012');
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
			'C:\WWW\3Skss.cz\Web/temp/cache/nette.application/touch'
		));
		$service->setMapping(['*' => 'App\*Module\Presenters\*Presenter']);
		return $service;
	}


	public function createServiceAuthenticator(): App\Models\UserManager
	{
		return new App\Models\UserManager(
			$this->getService('database.default.explorer'),
			$this->getService('security.passwords'),
			$this->getService('061')
		);
	}


	public function createServiceCache__storage(): Nette\Caching\Storage
	{
		return new Nette\Caching\Storages\FileStorage('C:\WWW\3Skss.cz\Web/temp/cache');
	}


	public function createServiceContainer(): Container_54954030e2
	{
		return $this;
	}


	public function createServiceCourseFamily(): App\Components\Courses\CourseFamily\CourseFamily
	{
		$service = new App\Components\Courses\CourseFamily\CourseFamily;
		$service->courseLevelRepo = $this->getService('049');
		$service->courseFormDS = $this->getService('024');
		$service->courseFamilyRepo = $this->getService('050');
		return $service;
	}


	public function createServiceCourseLevel(): App\Components\Courses\CourseLevel\CourseLevel
	{
		$service = new App\Components\Courses\CourseLevel\CourseLevel;
		$service->userRepo = $this->getService('061');
		$service->courseLevelRepo = $this->getService('049');
		$service->courseLevelDS = $this->getService('025');
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
		return new App\Components\CustomList\Models\CustomRepository($this->getService('database.default.explorer'));
	}


	public function createServiceDatabase__default__connection(): Nette\Database\Connection
	{
		$service = new Nette\Database\Connection('mysql:host=127.0.0.1;dbname=skss', 'root', 'root', []);
		Nette\Bridges\DatabaseTracy\ConnectionPanel::initialize(
			$service,
			true,
			'default',
			true,
			$this->getService('tracy.bar'),
			$this->getService('tracy.blueScreen')
		);
		return $service;
	}


	public function createServiceDatabase__default__conventions(): Nette\Database\Conventions\DiscoveredConventions
	{
		return new Nette\Database\Conventions\DiscoveredConventions($this->getService('database.default.structure'));
	}


	public function createServiceDatabase__default__explorer(): Nette\Database\Explorer
	{
		return new Nette\Database\Explorer(
			$this->getService('database.default.connection'),
			$this->getService('database.default.structure'),
			$this->getService('database.default.conventions'),
			$this->getService('cache.storage')
		);
	}


	public function createServiceDatabase__default__structure(): Nette\Database\Structure
	{
		return new Nette\Database\Structure($this->getService('database.default.connection'), $this->getService('cache.storage'));
	}


	public function createServiceDialogWindow(): App\Components\DialogWindow\DialogWindow
	{
		return new App\Components\DialogWindow\DialogWindow;
	}


	public function createServiceFormBootcamp(): App\Components\Courses\FormBootcamp\FormBootcamp
	{
		$service = new App\Components\Courses\FormBootcamp\FormBootcamp;
		$service->userRepo = $this->getService('061');
		$service->formBootcampParticipantDS = $this->getService('029');
		$service->formBootcampDS = $this->getService('028');
		$service->courseRepo = $this->getService('050');
		$service->bootcampPM = $this->getService('037');
		$service->bootcampClassRoleRepo = $this->getService('043');
		return $service;
	}


	public function createServiceFormBootcampParticipant(): App\Components\Courses\FormBootcampParticipant\FormBootcampParticipant
	{
		$service = new App\Components\Courses\FormBootcampParticipant\FormBootcampParticipant;
		$service->userRepo = $this->getService('061');
		$service->formBootcampParticipantDS = $this->getService('029');
		$service->bootcampClassRoleRepo = $this->getService('043');
		return $service;
	}


	public function createServiceFormDetachment(): App\Components\FormDetachment\FormDetachment
	{
		$service = new App\Components\FormDetachment\FormDetachment;
		$service->detachmentFormDS = $this->getService('026');
		$service->detachmentDM = $this->getService('017');
		$service->centerRepo = $this->getService('046');
		return $service;
	}


	public function createServiceFormSquad(): App\Components\FormSquad\FormSquad
	{
		$service = new App\Components\FormSquad\FormSquad;
		$service->squadTypeRepo = $this->getService('059');
		$service->squadRepo = $this->getService('058');
		$service->squadFormDS = $this->getService('030');
		$service->squadDM = $this->getService('020');
		$service->detachmentRepo = $this->getService('051');
		$service->centerRepo = $this->getService('046');
		return $service;
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


			public function __construct(Container_54954030e2 $container)
			{
				$this->container = $container;
			}


			public function create(): Latte\Engine
			{
				$service = new Latte\Engine;
				$service->setTempDirectory('C:\WWW\3Skss.cz\Web/temp/cache/latte');
				$service->setAutoRefresh();
				$service->setStrictTypes(false);
				$service->setContentType('html');
				Nette\Utils\Html::$xhtml = false;
				$service->addProvider('webpackAssetLocator', $this->container->getService('webpack.assetLocator'));
				$service->onCompile[] = function ($engine) { Oops\WebpackNetteAdapter\Latte\WebpackMacros::install($engine->getCompiler()); };
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
		$service->directory = 'C:\WWW\3Skss.cz\Web\app/migrations/basic-data';
		$service->dependencies = ['structures'];
		$service->generator = null;
		return $service;
	}


	public function createServiceMigrations__group__dummyData(): Nextras\Migrations\Entities\Group
	{
		$service = new Nextras\Migrations\Entities\Group;
		$service->name = 'dummy-data';
		$service->enabled = true;
		$service->directory = 'C:\WWW\3Skss.cz\Web\app/migrations/dummy-data';
		$service->dependencies = ['structures', 'basic-data'];
		$service->generator = null;
		return $service;
	}


	public function createServiceMigrations__group__structures(): Nextras\Migrations\Entities\Group
	{
		$service = new Nextras\Migrations\Entities\Group;
		$service->name = 'structures';
		$service->enabled = true;
		$service->directory = 'C:\WWW\3Skss.cz\Web\app/migrations/structures';
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
		return new App\Components\SearchFilter\Models\SearchFilterRepository($this->getService('database.default.explorer'));
	}


	public function createServiceSecurity__authorizator(): Nette\Security\Authorizator
	{
		$service = new Nette\Security\Permission;
		$service->addRole('guest', null);
		$service->addRole('member', ['guest']);
		$service->addRole('admin', ['member']);
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
		$service->addResource('Admin:Sign');
		$service->addResource('Member:Dashboard');
		$service->allow('admin');
		$service->allow('guest', 'Admin:Dashboard', 'login');
		$service->allow('guest', 'Admin:Sign', 'login');
		$service->allow('guest', 'Admin:Dashboard', 'register');
		$service->allow('guest', 'Member:Dashboard', 'login');
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
		$service->setOptions(['readAndClose' => null, 'cookieSamesite' => 'Lax']);
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


	public function createServiceUserDetail(): App\Components\UserDetail\UserDetail
	{
		$service = new App\Components\UserDetail\UserDetail;
		$service->userRepo = $this->getService('061');
		$service->userFormDS = $this->getService('031');
		$service->user = $this->getService('security.user');
		$service->squadRepo = $this->getService('058');
		$service->rankRepo = $this->getService('056');
		$service->instructorRepo = $this->getService('054');
		$service->courseRepo = $this->getService('050');
		$service->courseCompletitionTypeRepo = $this->getService('048');
		$service->courseCompletedRepo = $this->getService('047');
		return $service;
	}


	public function createServiceUserQualification(): App\Components\Courses\UserQualification\UserQualification
	{
		$service = new App\Components\Courses\UserQualification\UserQualification;
		$service->userCourseDetailFormDS = $this->getService('032');
		$service->instructorRepo = $this->getService('054');
		$service->customListFactory = $this->getService('012');
		$service->courseRepo = $this->getService('050');
		$service->courseCompletedRepo = $this->getService('047');
		$service->completitionTypeRepo = $this->getService('048');
		return $service;
	}


	public function createServiceWebpack__assetLocator(): Oops\WebpackNetteAdapter\AssetLocator
	{
		return new Oops\WebpackNetteAdapter\AssetLocator(
			$this->getService('webpack.buildDirProvider'),
			$this->getService('webpack.pathProvider'),
			$this->getService('webpack.assetResolver.debug'),
			$this->getService('webpack.devServer'),
			[]
		);
	}


	public function createServiceWebpack__assetResolver(): Oops\WebpackNetteAdapter\AssetNameResolver\AssetNameResolverInterface
	{
		return new Oops\WebpackNetteAdapter\AssetNameResolver\IdentityAssetNameResolver;
	}


	public function createServiceWebpack__assetResolver__debug(): Oops\WebpackNetteAdapter\AssetNameResolver\DebuggerAwareAssetNameResolver
	{
		return new Oops\WebpackNetteAdapter\AssetNameResolver\DebuggerAwareAssetNameResolver($this->getService('webpack.assetResolver'));
	}


	public function createServiceWebpack__buildDirProvider(): Oops\WebpackNetteAdapter\BuildDirectoryProvider
	{
		return new Oops\WebpackNetteAdapter\BuildDirectoryProvider(
			'C:\WWW\3Skss.cz\Web\www/assets',
			$this->getService('webpack.devServer')
		);
	}


	public function createServiceWebpack__devServer(): Oops\WebpackNetteAdapter\DevServer
	{
		return new Oops\WebpackNetteAdapter\DevServer(true, 'http://localhost:8000/assets', null, 0.1, new GuzzleHttp\Client);
	}


	public function createServiceWebpack__pathProvider(): Oops\WebpackNetteAdapter\PublicPathProvider
	{
		$service = new Oops\WebpackNetteAdapter\PublicPathProvider(
			'assets/',
			$this->getService('webpack.pathProvider.basePathProvider'),
			$this->getService('webpack.devServer')
		);
		$this->getService('tracy.bar')->addPanel(new Oops\WebpackNetteAdapter\Debugging\WebpackPanel(
			$service,
			$this->getService('webpack.assetResolver.debug'),
			$this->getService('webpack.devServer')
		));
		return $service;
	}


	public function createServiceWebpack__pathProvider__basePathProvider(): Oops\WebpackNetteAdapter\BasePath\BasePathProvider
	{
		return new Oops\WebpackNetteAdapter\BasePath\NetteHttpBasePathProvider($this->getService('http.request'));
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
			$this->getService('session.session')->autoStart(false);
		})();
		// tracy.
		(function () {
			if (!Tracy\Debugger::isEnabled()) { return; }
			Tracy\Debugger::getLogger()->mailer = [new Tracy\Bridges\Nette\MailSender($this->getService('mail.mailer')), 'send'];
		})();
	}
}
