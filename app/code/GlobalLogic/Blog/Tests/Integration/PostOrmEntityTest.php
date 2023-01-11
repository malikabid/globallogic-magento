<?php

namespace GlobalLogic\Blog\Tests\Integration;

/**
 * @magentoDbIsolation enabled
 */
class PostOrmEntityTest extends \PHPUnit\Framework\TestCase
{
    private $_objectManger;

    protected function setUp(): void
    {
        $this->_objectManger = \Magento\TestFramework\ObjectManager::getInstance();
    }

    private function initializePostModel()
    {
        return $this->_objectManger->create(\GlobalLogic\Blog\Model\Post::class);
    }

    private function initializePostResourceModel()
    {
        return $this->_objectManger->create(\GlobalLogic\Blog\Model\ResourceModel\Post::class);
    }
    public function testCanSaveAndLoad()
    {
        $postModel = $this->initializePostModel();

        $postModel->setName('Test Blog Post 1');
        $postModel->setShortDescription('Test Post Short Description');
        $postModel->setContent('This post is for ORM testing only');
        $postModel->setEnabled(1);
        $this->initializePostResourceModel()->save($postModel);

        $loadedPost = $this->initializePostModel();
        $this->initializePostResourceModel()->load($loadedPost, $postModel->getId());
        $this->assertSame($loadedPost->getName(), $postModel->getName());

        $expectedUrlKey = 'test-blog-post-1';

        $this->assertSame($expectedUrlKey, $loadedPost->getUrlKey());
    }
}
