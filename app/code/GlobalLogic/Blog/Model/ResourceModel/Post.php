<?php

namespace GlobalLogic\Blog\Model\ResourceModel;

use GlobalLogic\Blog\Helper\Data as HelperData;
use Magento\Framework\Model\AbstractModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    private $helper;

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        HelperData $helper
    ) {
        $this->helper = $helper;
        return parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('blog_post', 'entity_id');
    }

    protected function _beforeSave(AbstractModel $object)
    {
        $object->setUrlKey($this->helper->generateUrlKey($object->getName()));
        return $this;
    }
}
