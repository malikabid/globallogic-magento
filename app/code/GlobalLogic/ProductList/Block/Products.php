<?php

namespace GlobalLogic\ProductList\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;


class Products extends \Magento\Framework\View\Element\Template
{

    private $_productRepository;

    private $_searchCriteriaBuilder;

    private $_filterBuilder;

    private $_sortOderBuilder;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        $this->_filterBuilder = $filterBuilder;
        $this->_productRepository = $productRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_sortOderBuilder = $sortOrderBuilder;
        parent::__construct($context, $data);
    }

    public function getProductList()
    {
        return $this->getProductsFromRepository();
    }

    public function getProductCount()
    {
        return count($this->getProductsFromRepository());
    }

    private function setProductTypeFilter()
    {
        $configProductFilter = $this->_filterBuilder
            ->setField('type_id')
            ->setValue('configurable')
            ->setConditionType('eq')
            ->create();

        $this->_searchCriteriaBuilder->addFilters([$configProductFilter]);
    }

    private function setProductNameFilter()
    {
        $productNameFilter = $this->_filterBuilder
            ->setField('name')
            ->setValue('M%')
            ->setConditionType('like')
            ->create();

        $this->_searchCriteriaBuilder->addFilters([$productNameFilter]);
    }

    private function setProdcutSort()
    {
        $sort = $this->_sortOderBuilder
            ->setField('name')
            ->setDescendingDirection()
            ->create();
        $this->_searchCriteriaBuilder->addSortOrder($sort);
    }

    private function setPaging()
    {
        $this->_searchCriteriaBuilder->setPageSize(5);
        $this->_searchCriteriaBuilder->setCurrentPage(2);
    }
    protected function getProductsFromRepository()
    {
        $criteria = $this->_searchCriteriaBuilder->create();

        $this->setProductTypeFilter();
        $this->setProductNameFilter();
        $this->setProdcutSort();
        $this->setPaging();

        $products = $this->_productRepository->getList($criteria);
        return $products->getItems();
    }
}
