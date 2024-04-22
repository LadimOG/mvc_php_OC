<?php

require_once('src/models/post/post.php');
require_once('src/models/comment/comment.php');

function post($identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);
    require_once 'templates/post.php';
}
