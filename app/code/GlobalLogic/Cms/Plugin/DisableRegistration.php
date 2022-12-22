<?php

namespace GlobalLogic\Cms\Plugin;

use Magento\Customer\Model\Registration;

class DisableRegistration
{
    public function afterIsAllowed(Registration $subject, $result)
    {
        return true;
    }
}
