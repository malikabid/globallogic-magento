<?php

namespace GlobalLogic\Blog\Model\Api;

use GlobalLogic\Blog\Api\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getList()
    {
        return 'This method fetches list of all posts';
    }

    public function get(int $id)
    {
        return "Fetches post wth ID = $id";
    }
}
