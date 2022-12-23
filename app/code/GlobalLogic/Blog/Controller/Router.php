<?php

namespace GlobalLogic\Blog\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\RequestInterface;
use GlobalLogic\Blog\Model\Post as PostModel;

class Router implements RouterInterface
{



    private $actionFactory;

    private $postModel;

    public function __construct(

        ActionFactory $actionFactory,
        PostModel $postModel
    ) {
        $this->actionFactory = $actionFactory;
        $this->postModel = $postModel;
    }

    public function match(RequestInterface $request)
    {
        $identifier  = trim($request->getPathInfo(), '/');

        $id = '';

        $finalKey = explode('/', $identifier);
        $urlKey = end($finalKey);

        $post = $this->postModel->load($urlKey, 'url_key');

        if ($post->getId()) {
            $id = $post->getId();
        }

        if ($id) {
            $request->setModuleName('blog')->setControllerName('index')->setActionName('view')->setParam('id', $id);
        }
        return $this->actionFactory->create(
            Forward::class,
            ['request' => $request]
        );
    }
}
