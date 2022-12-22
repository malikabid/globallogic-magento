<?php

namespace GlobalLogic\PluginExample\Plugin\Block\Html\Breadcrumbs;

use Magento\Theme\Block\Html\Breadcrumbs;

class ModifyCrumbLabel
{
    public function beforeAddCrumb(Breadcrumbs $subject, $crumbName, $crumbInfo)
    {
        $crumbInfo['label'] = $crumbInfo['label'] . '$';
        return [$crumbName, $crumbInfo];
    }

    public function aroundAddCrumb(Breadcrumbs $subject, callable $proceed, $crumbName, $crumbInfo)
    {
        $crumbInfo['label'] = $crumbInfo['label'] . '#';
        $proceed($crumbName, $crumbInfo);
    }
}
