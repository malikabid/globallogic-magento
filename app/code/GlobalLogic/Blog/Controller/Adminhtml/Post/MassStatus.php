<?php

namespace GlobalLogic\Blog\Controller\Adminhtml\Post;

use Exception;
use GlobalLogic\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

class MassStatus extends \Magento\Backend\App\Action
{

    private $filter;

    private $collectionFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        CollectionFactory $collectionFactory

    ) {
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
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
        $status = (int) $this->getRequest()->getParam('status');

        $postsUpdated = 0;

        foreach ($collection as $post) {
            try {
                $post->setEnabled($status)->save();
                $postsUpdated++;
            } catch (Exception $e) {
                $this->_getSession()->addException(
                    $e,
                    __('Something went wrong')
                );
            }
        }

        if ($postsUpdated) {
            $this->messageManager->addSuccessMessage(__('%1 records(s) updated', $postsUpdated));
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
