<?php

namespace GlobalLogic\HelloWorld\Test\Integration\Plugin;

use Magento\TestFramework\ObjectManager;
use Magento\TestFramework\Interception\PluginList;


class DisbleRegistrationPluginIntegrationTest extends \PHPUnit\Framework\TestCase
{
    public function testDisableRegistrationPluginExists()
    {
        $objectManager = ObjectManager::getInstance();

        $pluginList = $objectManager->create(PluginList::class);

        $pluginInfo = $pluginList->get(\Magento\Customer\Model\Registration::class, []);

        $this->assertSame(\GlobalLogic\HelloWorld\Plugin\DisableRegistration::class, $pluginInfo['gl_helloworld_disable_reg']['instance']);
    }
}
