<?php

namespace GlobalLogic\CutomAttributes\Test\Unit;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote\Item as QuoteItem;
use GlobalLogic\CutomAttributes\Observer\AddFlavourToQuoteItem;
use Magento\Framework\Api\AttributeInterface;

class AddFlavourToQuoteItemTest extends \PHPUnit\Framework\TestCase
{
    public function testClassExists()
    {

        $this->assertInstanceOf(
            ObserverInterface::class,
            new AddFlavourToQuoteItem()
        );
    }

    public function testCopiesFlavorToQuoteItem()
    {
        $mockProduct = $this->getMockBuilder(Product::class)
            ->disableOriginalConstructor()
            ->getMock();

        // $mockAttribute = $this->getMockBuilder(AttributeInterface::class)
        //     ->getMock();
        // $mockAttribute->method('getValue')->willReturn('spicy');
        // $mockProduct->method('getCustomAttribute')->with('flavour')->willReturn($mockAttribute);

        $mockProduct->method('getData')->with('flavour')->willReturn('spicy');

        $mockQuoteItem = $this->getMockBuilder(QuoteItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockQuoteItem->expects($this->once())->method('setData')->with('flavour', 'spicy');

        $mockEvent = $this->getMockBuilder(\Magento\Framework\Event\Observer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockEvent->method('getData')->willReturnMap([
            ['product', null, $mockProduct],
            ['quote_item', null, $mockQuoteItem]
        ]);

        (new AddFlavourToQuoteItem())->execute($mockEvent);
    }
}
