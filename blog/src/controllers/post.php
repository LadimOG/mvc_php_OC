<?php

namespace App\Controllers;

use App\Lib\Database;
use App\Models\Comment\CommentRepository;
use App\Models\Post\PostRepository;

class Post
{
    function post($identifier)
    {
        $repository = new PostRepository();
        $repository->connection = new Database();
        $post = $repository->getPost($identifier);

        $repositoryComment = new CommentRepository();
        $repositoryComment->connection = new Database();
        $comments = $repositoryComment->getComments($identifier);

        require('templates/post.php');
    }
}
