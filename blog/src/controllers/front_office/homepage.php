<?php

namespace App\Controllers\Front_office\Homepage;

require_once('src/models/post/post.php');
require_once 'src/lib/database.php';

use App\Models\Post\Post\PostRepository;
use App\Lib\Database\DatabaseConnection;

class ShowHomePage
{
    function homepage()
    {
        $repository = new PostRepository();
        $repository->connection = new DatabaseConnection();
        $posts = $repository->getPosts();
        require('templates/homePage.php');
    }
}
