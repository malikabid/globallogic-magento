<?php

namespace GlobalLogic\HelloWorld\Test\Integration;

use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Request;
use Magento\TestFramework\ObjectManager;
use Magento\Framework\App\Router\Base as BaseRouter;
use Magento\Framework\App\Route\ConfigInterface as RouteConfig;

class RouteConfigTest extends TestCase
{

    private $moduleName = 'GlobalLogic_HelloWorld';

    /** var ObjectManager $objectManager */
    private $objectManager;

    protected function setUp(): void
    {
        $this->objectManager = ObjectManager::getInstance();
    }


    /**
     * @magentoAppArea frontend
     */
    public function testTheModuleRegistersRouter()
    {
        /** var RouteConfig $routeConfig */
        $routeConfig = $this->objectManager->create(RouteConfig::class);
        $this->assertContains($this->moduleName, $routeConfig->getModulesByFrontName('helloworld'));
    }

    /**
     * @magentoAppArea frontend
     */
    public function testHelloworldIndexIndexCanBeFound()
    {
        /** @var Request $request */
        $request = $this->objectManager->create(Request::class);
        $request->setModuleName('helloworld');
        $request->setControllerName('index');
        $request->setActionName('index');

        /**@var BaseRouter $baseRouter */
        $baseRouter = $this->objectManager->create(BaseRouter::class);
        $expectedAction = \GlobalLogic\HelloWorld\Controller\Index\Index::class;

        $this->assertInstanceOf($expectedAction, $baseRouter->match($request), "The Action class was not found");
    }
}
