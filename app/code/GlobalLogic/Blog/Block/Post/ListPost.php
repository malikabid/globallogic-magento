<?php

namespace GlobalLogic\Blog\Block\Post;

use GlobalLogic\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class ListPost extends \Magento\Framework\View\Element\Template
{

    private $blogCollectionFactory;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        PostCollectionFactory $postCollectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->blogCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getPostList()
    {
        $blogCollection = $this->blogCollectionFactory->create()->addFieldToFilter('enabled', 1);
        return $blogCollection->getItems();
    }
}
