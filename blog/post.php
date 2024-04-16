<?php

require_once 'src/models/model.php';

if(isset($_GET['id'])&& !empty($_GET['id'])){
    $identifier = (int) $_GET['id'];
    $post = getPost($identifier);
    $comments = getComments($identifier);
    require_once 'templates/post.php';
}

