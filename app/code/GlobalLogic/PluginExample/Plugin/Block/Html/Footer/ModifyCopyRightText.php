<?php

namespace GlobalLogic\PluginExample\Plugin\Block\Html\Footer;

use Magento\Theme\Block\Html\Footer;

class ModifyCopyRightText
{
    public function afterGetCopyright(Footer $subject, $result)
    {
        return 'Custom CopyRight';
    }
}
