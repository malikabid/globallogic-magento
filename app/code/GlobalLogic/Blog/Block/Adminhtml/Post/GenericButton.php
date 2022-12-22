<?php

namespace GlobalLogic\Blog\Block\Adminhtml\Post;

use GlobalLogic\Blog\Model\Post;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{

    protected $context;

    protected $post;

    public function __construct(
        Context $context,
        Post $post
    ) {
        $this->context = $context;
        $this->post = $post;
    }

    public function getPostId()
    {
        try {
            return $this->post->load(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
