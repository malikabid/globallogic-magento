<?php

namespace GlobalLogic\CutomAttributes\Model\Entity\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Ingredients extends AbstractSource
{
    public function getAllOptions()
    {
        return [
            [
                'label' => 'Tata Namak',
                'value' => 'salt'
            ],
            [
                'label' => 'Teekha',
                'value' => 'chilli'
            ],
            [
                'label' => 'Meetha',
                'value' => 'gud'
            ]
        ];
    }
}
