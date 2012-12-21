<?php
/**
 * @package    Sandbox
 * @subpackage Module
 */
namespace Sandbox\Module\Common;

use BEAR\Sunday\Module as SundayModule;
use BEAR\Package\Module as PackageModule;
use Sandbox\Interceptor\PostFormValidator;
use Sandbox\Interceptor\TimeMessage;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

/**
 * Application module
 *
 * @package    Sandbox
 * @subpackage Module
 */
class AppModule extends AbstractModule
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        parent::__construct();
    }

    /**
     * (non-PHPdoc)
     * @see Ray\Di.AbstractModule::configure()
     */
    protected function configure()
    {
        // install package module
        $this->install(new SundayModule\Constant\NamedModule($this->config));
        $scheme = __NAMESPACE__ . '\SchemeCollectionProvider';
        $this->install(new PackageModule\Package\PackageModule($this, $scheme));

        // install twig
        //$this->install(new PackageModule\TemplateEngine\Twig\TwigModule($this));

        // dependency binding for application
        $this->bind('BEAR\Sunday\Application\Context')->to('Sandbox\App');
        //$this->bind()->annotatedWith('mytest')->toInstance('Hola');

        // aspect weaving for application
        $this->installTimeMessage();
    }

    /**
     * Add time message aspect
     */
    private function installTimeMessage()
    {
        // time message binding
        $this->bindInterceptor(
            $this->matcher->subclassesOf('Sandbox\Resource\App\First\Greeting'),
            $this->matcher->any(),
            [new TimeMessage]
        );
    }
}
