<?php

namespace GlobalLogic\HelloWorld\Test\Integration;

use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;
use Magento\Framework\Component\ComponentRegistrar;

class SetupTest extends \PHPUnit\Framework\TestCase
{

    public function testTheModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $this->assertArrayHasKey('GlobalLogic_HelloWorld', $registrar->getPaths(ComponentRegistrar::MODULE));
    }

    public function testTheModuleIsRegisteredAndEnabledInSandbox()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = ObjectManager::getInstance();

        /** @var ModuleList $moduleList */
        $moduleList = $objectManager->create(ModuleList::class);

        $isModuleListed = $moduleList->has('GlobalLogic_HelloWorld');

        $this->assertTrue($isModuleListed, "Module not listed yet");
    }


    public function testTheModuleIsRegisteredAndEnabledInReal()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = ObjectManager::getInstance();

        $dirList = $objectManager->create(\Magento\Framework\App\Filesystem\DirectoryList::class, ['root' => BP]);
        $configReader = $objectManager->create(\Magento\Framework\App\DeploymentConfig\Reader::class, ['dirList' => $dirList]);
        $deploymentConfig = $objectManager->create(\Magento\Framework\App\DeploymentConfig::class, ['reader' => $configReader]);

        /** @var ModuleList $moduleList */
        $moduleList = $objectManager->create(ModuleList::class, ['config' => $deploymentConfig]);

        $isModuleListed = $moduleList->has('GlobalLogic_HelloWorld');

        $this->assertTrue($isModuleListed, "Module not listed yet");
    }
}
