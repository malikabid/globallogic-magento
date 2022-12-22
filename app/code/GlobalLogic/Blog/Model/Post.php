<?php

namespace GlobalLogic\Blog\Model;

use GlobalLogic\Blog\Model\ResourceModel\Post as PostResourceModel;

class Post extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PostResourceModel::class);
    }
}
