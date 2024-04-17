<?php

require_once 'src/models/model.php';
function homePage()
{
    $posts = getPosts();
    require_once 'templates/homePage.php';
}