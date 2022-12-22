<?php

namespace GlobalLogic\Blog\Model\ResourceModel\Post;

use GlobalLogic\Blog\Model\Post as PostModel;
use GlobalLogic\Blog\Model\ResourceModel\Post as PostResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


class Collection extends AbstractCollection
{

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PostModel::class, PostResourceModel::class);
    }
}
