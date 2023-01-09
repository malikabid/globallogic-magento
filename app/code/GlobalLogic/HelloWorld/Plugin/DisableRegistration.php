<?php

namespace GlobalLogic\HelloWorld\Plugin;

use Magento\Customer\Model\Registration;
use Magento\Framework\App\Config\ScopeConfigInterface;

class DisableRegistration
{
    const XML_PATH_DISABLE_CUSTOMER_REGISTRATION = 'customer/create_account/disable_customer_registration';

    /** @var ScopeConfigInterface $scopeConfig */
    private $scopeConfig;

    /**
     * Constructor function
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }


    public function afterIsAllowed(Registration $subject, $result)
    {
        if ($this->scopeConfig->isSetFlag(self::XML_PATH_DISABLE_CUSTOMER_REGISTRATION)) {
            return false;
        }

        return $result;
    }
}
