<?php

namespace GlobalLogic\Blog\Block\Post;

use GlobalLogic\Blog\Model\PostFactory;

class View extends \Magento\Framework\View\Element\Template
{
    private $_postFactory;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        PostFactory $postFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->_postFactory = $postFactory;
        parent::__construct($context, $data);
    }

    public function getBlogPost()
    {
        $id = $this->getRequest()->getParam('id');
        $post = $this->_postFactory->create()->load($id);
        return $post;
    }
}
