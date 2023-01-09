<?php

namespace GlobalLogic\Blog\Api;

interface PostRepositoryInterface
{
    /**
     * Get Post List
     *
     * @return string
     */
    public function getList();

    /**
     * Get Post with given id
     * @param int $id
     * @return string
     */
    public function get(int $id);
}
