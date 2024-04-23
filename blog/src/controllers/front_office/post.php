<?php

namespace App\Controllers\Front_office\Post;

require_once('src/models/post/post.php');
require_once('src/models/comment/comment.php');
require_once 'src/lib/database.php';

use App\Models\Comment\Comment\CommentRepository;
use App\Models\Post\Post\PostRepository;
use App\Lib\Database\DatabaseConnection;


class ShowPost
{
    function post($identifier)
    {
        $repository = new PostRepository();
        $repository->connection = new DatabaseConnection();
        $post = $repository->getPost($identifier);

        $repositoryComment = new CommentRepository();
        $repositoryComment->connection = new DatabaseConnection();
        $comments = $repositoryComment->getComments($identifier);
        require('templates/post.php');
    }
}
