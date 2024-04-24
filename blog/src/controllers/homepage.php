<?php

namespace App\Controllers;

use App\Lib\Database;
use App\Models\Post\PostRepository;

class HomePage
{
    function homepage()
    {
        $repository = new PostRepository();
        $repository->connection = new Database();
        $posts = $repository->getPosts();
        require('templates/homePage.php');
    }
}
