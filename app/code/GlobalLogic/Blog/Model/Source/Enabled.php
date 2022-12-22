<?php

namespace GlobalLogic\Blog\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Enabled implements OptionSourceInterface
{
    public function toOptionArray()
    {
        $options = [
            [
                'label' => __('No'),
                'value' => 0
            ],
            [
                'label' => __('Yes'),
                'value' => 1
            ]
        ];

        return $options;
    }
}
