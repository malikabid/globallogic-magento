<?php

namespace GlobalLogic\Blog\Model\ResourceModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('blog_post', 'entity_id');
    }
}
