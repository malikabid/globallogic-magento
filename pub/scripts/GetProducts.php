<?php

require __DIR__ . '/../../app/bootstrap.php';

$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();

$state = $objectManager->get(\Magento\Framework\App\State::class);
$state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);

// $productCollection->addIdFilter([1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 23]);

$productCollectionFactory = $objectManager->create(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory::class);
$productCollection = $productCollectionFactory->create()
    ->addAttributeToSelect('*')
    // ->addFieldToFilter('type_id', ['in' => ['configurable', 'bundle']])
    // ->addAttributeToFilter('activity', ['finset' => '11'])
    // ->addAttributeToFilter('name', ['like' => 'Sprite%'])
    ->addAttributeToFilter(
        [
            [
                'attribute' => 'name',
                'like' => 'Sprite%'
            ],
            [
                'attribute' => 'type_id',
                'eq' => 'simple'
            ]
        ]
    )

    // ->setPageSize(10)
    // ->setCurPage(1)
    ->load();



echo $productCollection->getSelect();
echo "We have total of " . $productCollection->getSize() . " Products <br/>";

foreach ($productCollection as $product) {
    echo $product->getName() . " : " . $product->getSku() . " : " . $product->getTypeId() . "<br/>";
}
