<?php

namespace GlobalLogic\CutomAttributes\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddFlavourToQuoteItem implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $product = $observer->getData('product');
        $quoteItem = $observer->getData('quote_item');

        $quoteItem->setData('flavour', $product->getData('flavour'));
    }
}
