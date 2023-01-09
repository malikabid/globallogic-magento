<?php

namespace GlobalLogic\HelloWorld\Test\Unit\Plugin;

use Magento\Customer\Model\Registration;
use Magento\Framework\App\Config\ScopeConfigInterface;

class DisableRegistrationUnitTest extends \PHPUnit\Framework\TestCase
{

    private $plugin;

    private $mockCustomerRegistrationModel;

    private $scopeConfigInterface;


    protected function setUp(): void
    {
        $this->mockCustomerRegistrationModel = $this->getMockBuilder(Registration::class)->getMock();
        $this->scopeConfigInterface = $this->createMock(ScopeConfigInterface::class);
        $this->plugin = new \GlobalLogic\HelloWorld\Plugin\DisableRegistration($this->scopeConfigInterface);
    }

    // public function testAfterIsAllowedMethodCanBeCalled()
    // {
    //     $result = $this->plugin->afterIsAllowed(
    //         $this->mockCustomerRegistrationModel,
    //         true
    //     );

    //     $this->assertFalse((bool)$result);
    // }


    // public function testIsRegistrationDisabledOnConfigTrue()
    // {
    //     $this->scopeConfigInterface->method('isSetFlag')
    //         ->with('customer/create_account/disable_customer_registration')
    //         ->will($this->returnValue(true));

    //     $result = $this->plugin->afterIsAllowed(
    //         $this->mockCustomerRegistrationModel,
    //         true
    //     );
    //     $expected = false;
    //     $this->assertEquals($expected, $result);
    // }

    // public function testIsRegistrationEnabledOnConfigFalse()
    // {
    //     $this->scopeConfigInterface->method('isSetFlag')
    //         ->with('customer/create_account/disable_customer_registration')
    //         ->will($this->returnValue(false));

    //     $result = $this->plugin->afterIsAllowed(
    //         $this->mockCustomerRegistrationModel,
    //         true
    //     );
    //     $expected = true;

    //     $this->assertEquals($expected, $result);
    // }

    public function configDataProvider()
    {
        return [
            [true, false],
            [false, true]
        ];
    }

    /**
     * @dataProvider configDataProvider
     */
    public function testIsAllowedWithConfig($configVal, $expected)
    {
        $this->scopeConfigInterface->method('isSetFlag')
            ->with('customer/create_account/disable_customer_registration')
            ->will($this->returnValue($configVal));

        $result = $this->plugin->afterIsAllowed(
            $this->mockCustomerRegistrationModel,
            true
        );

        $this->assertEquals($expected, $result);
    }
}
