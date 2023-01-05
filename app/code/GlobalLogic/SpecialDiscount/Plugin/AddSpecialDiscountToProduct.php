<?php

namespace GlobalLogic\SpecialDiscount\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductSearchResultsInterface;

class AddSpecialDiscountToProduct
{
    public function afterGet(
        ProductRepositoryInterface $subject,
        ProductInterface $entity
    ) {
        $extensionAttributes = $entity->getExtensionAttributes();
        $extensionAttributes->setSpecialDiscount(10);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }


    public function afterGetList(
        ProductRepositoryInterface $subject,
        ProductSearchResultsInterface $searchCriteria
    ): ProductSearchResultsInterface {

        $prodcuts = [];
        foreach ($searchCriteria->getItems() as $entity) {
            $extensionAttributes = $entity->getExtensionAttributes();
            $extensionAttributes->setSpecialDiscount(10);
            $entity->setExtensionAttributes($extensionAttributes);

            $prodcuts[] = $entity;
        }

        $searchCriteria->setItems($prodcuts);
        return $searchCriteria;
    }
}
