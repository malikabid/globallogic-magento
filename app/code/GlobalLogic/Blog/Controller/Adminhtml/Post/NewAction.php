<?php

namespace GlobalLogic\Blog\Controller\Adminhtml\Post;

use Magento\Backend\Model\View\Result\ForwardFactory;



class NewAction extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'GlobalLogic_Blog::save';

    const PAGE_TITLE = 'Add New Blog';

    protected $resultForwardFactory;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        return parent::__construct($context);
    }


    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
