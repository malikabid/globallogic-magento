<?php

namespace GlobalLogic\Blog\Helper;

use Magento\Framework\Filter\TranslitUrl;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public function __construct(
        TranslitUrl $translitUrl,
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->translitUrl = $translitUrl;
        return parent::__construct($context);
    }
    public function getBlogUrl($urlKey = null)
    {
        if (is_object($urlKey)) {
            $urlKey = $urlKey->getUrlKey();
        }

        $url    = $this->getUrl('blog/' . $urlKey);
        $url    = explode('?', $url);
        $url    = $url[0];

        return rtrim($url, '/');
    }

    public function getUrl($route, $params = [])
    {
        return $this->_urlBuilder->getUrl($route, $params);
    }


    public function generateUrlKey($name)
    {
        $urlKey = $this->translitUrl->filter($name);
        return $urlKey;
    }
}
