<?php

namespace App\Controllers;


use App\Models\Comment\CommentRepository;
use App\Models\Post\PostRepository;
use Exception;

class Post
{
    function ShowPost($identifier)
    {
        $repository = new PostRepository();
        $post = $repository->getPost($identifier);
        if ($post === null) {
            throw new Exception('Cette identifiant n\'existe pas !');
        }


        $repositoryComment = new CommentRepository();
        $comments = $repositoryComment->getComments($identifier);


        require('templates/post.php');
    }
}
