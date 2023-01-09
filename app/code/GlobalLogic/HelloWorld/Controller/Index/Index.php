<?php

namespace GlobalLogic\HelloWorld\Controller\Index;

use Magento\Framework\Controller\Result\RedirectFactory as RedirectResultFactory;

class Index extends  \Magento\Framework\App\Action\Action
{

    private $context;

    private $_pageFactory;

    private $useCase;

    /**@var RedirectResultFactory */
    private $redirectResultFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \stdClass $useCase
    ) {
        $this->redirectResultFactory = $context->getResultRedirectFactory();
        $this->useCase = $useCase;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    public function execute()
    {


        if (!$this->isPostRequest()) {
            $result = $this->_pageFactory->create();
            $result->setHttpResponseCode(405);
            return $result;
        }
        try {
            $this->useCase->doSomething($this->getRequest()->getParams());
        } catch (\Exception $c) {
            $result = $this->_pageFactory->create();
            $result->setHttpResponseCode(400);
            return $result;
        }

        $redirect = $this->redirectResultFactory->create();
        $redirect->setPath('/');

        return $redirect;
    }


    private function isPostRequest()
    {
        return $this->getRequest()->getMethod() === 'POST';
    }
}
