<?php

namespace App\Controllers;

use App\Models\Post\PostRepository;

class HomePage
{
    function index()
    {
        $repository = new PostRepository();
        $posts = $repository->getPosts();
        require('templates/homePage.php');
    }
}
