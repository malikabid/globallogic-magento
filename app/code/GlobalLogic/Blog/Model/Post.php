<?php

namespace GlobalLogic\Blog\Model;

use GlobalLogic\Blog\Model\ResourceModel\Post as PostResourceModel;

class Post extends \Magento\Framework\Model\AbstractModel
{
    private $helper;

    public function __construct(
        \GlobalLogic\Blog\Helper\Data $helper,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->helper = $helper;
        return parent::__construct($context, $registry);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PostResourceModel::class);
    }

    public function getUrl()
    {
        return $this->helper->getBlogUrl($this);
    }
}
