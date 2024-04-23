<?php

require_once('src/models/post/post.php');
require_once('src/models/comment/comment.php');

function post($identifier)
{
    $repository = new PostRepository();
    $post = $repository->getPost($identifier);
    $comments = getComments($identifier);
    require('templates/post.php');
}
