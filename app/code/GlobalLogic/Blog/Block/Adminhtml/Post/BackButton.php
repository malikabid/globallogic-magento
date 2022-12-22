<?php

namespace GlobalLogic\Blog\Block\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'class' => 'back',
            'on_click' => sprintf("location.href='%s';", $this->getBackUrl()),
            'sort_order' => 10
        ];
    }

    protected function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}
