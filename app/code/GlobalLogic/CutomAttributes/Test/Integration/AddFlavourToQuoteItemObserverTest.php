<?php

namespace GlobalLogic\CutomAttributes\Test\Integration;

use Magento\Catalog\Model\Product;
use Magento\TestFramework\ObjectManager;
use Magento\Quote\Model\Quote\Item as QuoteItem;

class AddFlavourToQuoteItemObserverTest extends \PHPUnit\Framework\TestCase
{
    public function testAddsFlavourToQuoteItem()
    {
        $product = ObjectManager::getInstance()->create(Product::class);
        // $product->load(1);
        $product->setData('flavour', 'spicy');
        $quoteItem = ObjectManager::getInstance()->create(QuoteItem::class);

        $eventManager = ObjectManager::getInstance()->create(\Magento\Framework\Event\ManagerInterface::class);
        $eventManager->dispatch(
            'checkout_cart_product_add_after',
            ['quote_item' => $quoteItem, 'product' => $product]
        );

        $this->assertSame('spicy', $quoteItem->getData('flavour'));
    }
}
