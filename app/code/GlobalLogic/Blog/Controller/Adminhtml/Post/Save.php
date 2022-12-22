<?php

namespace GlobalLogic\Blog\Controller\Adminhtml\Post;

use GlobalLogic\Blog\Model\Post;
use Magento\Backend\App\Action\Context;


class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'GlobalLogic_Blog::save';

    const PAGE_TITLE = 'Save Blog';

    public function __construct(
        Context $context,
    ) {
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $model = $this->_objectManager->create(Post::class);
            if (!$data['entity_id']) {
                unset($data['entity_id']);
            }
            $model->setData($data);
            $model->save();
        }

        $id = $model->getId();

        if ($id) {
            $this->messageManager->addSuccessMessage(__('The post was saved successfulyy'));
        } else {
            $this->messageManager->addErrorMessage(__('Something went wrong while saving the post'));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/edit', ['id' => $id, '_current' => true]);

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
