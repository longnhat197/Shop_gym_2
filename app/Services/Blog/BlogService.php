<?php

namespace App\Services\Blog;

use App\Services\BaseService;
use App\Repositories\Blog\BlogRepositoryInterface;

class BlogService extends BaseService implements BlogServiceInterface
{
    public $repository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->repository = $blogRepository;
    }

    public function getLatestBlog($limit = 3){
        return $this->repository->getLatestBlog();
    }

}
