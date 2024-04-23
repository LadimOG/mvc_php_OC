<?php

require_once('src/models/post/post.php');
function homePage()
{
    $repository = new PostRepository();
    $posts = $repository->getPosts();
    require('templates/homePage.php');
}
