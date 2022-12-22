<?php

namespace GlobalLogic\CustomerRegistration\ViewModel;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Message implements ArgumentInterface
{
    const XML_PATH_DISABLE_MESSAGE = 'customer/create_account/disable_customer_registration_message';

    private $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getMessage()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_DISABLE_MESSAGE, ScopeInterface::SCOPE_STORE);
    }
}
