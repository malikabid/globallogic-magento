<?php

namespace GlobalLogic\Blog\Controller\Adminhtml\Post;

use Exception;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use GlobalLogic\Blog\Model\ResourceModel\Post\CollectionFactory;


class MassDelete extends \Magento\Backend\App\Action
{

    protected $filter;

    protected $collectionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory

    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        try {
            $collection->walk('delete');
            $this->messageManager->addSuccessMessage(__('Posts have been deleted.'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong while deleting'));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        return $resultRedirect;
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
