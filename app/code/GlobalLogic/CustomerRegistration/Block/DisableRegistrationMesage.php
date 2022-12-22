<?php

namespace GlobalLogic\CustomerRegistration\Block;

use Magento\Store\Model\ScopeInterface;

class DisableRegistrationMesage extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    private $context;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->context = $context;
        parent::__construct($context, $data);
    }

    public function getMessage()
    {
        return $this->context->getScopeConfig()->getValue('customer/create_account/disable_customer_registration_message', ScopeInterface::SCOPE_STORE);
    }
}
