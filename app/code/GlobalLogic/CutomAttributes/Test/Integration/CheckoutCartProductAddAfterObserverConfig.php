<?php

namespace GlobalLogic\CutomAttributes\Test\Integration;

use Magento\TestFramework\ObjectManager;

class CheckoutCartProductAddAfterObserverConfig extends \PHPUnit\Framework\TestCase
{
    public function testCheckoutCartProductAddAfterObserverIsConfigured()
    {
        $observerConfig = ObjectManager::getInstance()->create(\Magento\Framework\Event\ConfigInterface::class);
        $observers = $observerConfig->getObservers('checkout_cart_product_add_after');

        $this->assertArrayHasKey('gl_add_flavour_to_quote', $observers);

        $this->assertSame(
            \GlobalLogic\CustomAttributes\Observer\AddFlavourToQuoteItem::class,
            $observers['gl_add_flavour_to_quote']['instance']
        );
    }
}
