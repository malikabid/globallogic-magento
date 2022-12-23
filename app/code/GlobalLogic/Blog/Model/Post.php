<?php

namespace GlobalLogic\Blog\Model;

use GlobalLogic\Blog\Helper\Data as HelperData;
use GlobalLogic\Blog\Model\ResourceModel\Post as PostResourceModel;

class Post extends \Magento\Framework\Model\AbstractModel
{

    private $_helper;

    public function __construct(
        HelperData $helper,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
    ) {
        $this->_helper = $helper;
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

    public function getPostUrl()
    {
        return $this->_helper->getBlogUrl($this);
    }
}
