<?php

require_once('src/models/post/post.php');
function homePage()
{
    $posts = getPosts();
    require_once 'templates/front/homePage.php';
}
