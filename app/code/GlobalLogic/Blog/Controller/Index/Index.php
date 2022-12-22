<?php

namespace GlobalLogic\Blog\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // return $this->_pageFactory->create();
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('Global Blogs'));
        $this->_view->renderLayout();
    }
}
