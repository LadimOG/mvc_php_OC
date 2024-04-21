<?php

require_once 'src/models/model.php';

function post($identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);
    require_once 'templates/front/post.php';
}
