<?php
session_start();

require 'vendor/autoload.php';

// spl_autoload_register(function ($class) {
//     $path = str_replace('\\', '/', $class);
//     $path = str_replace("App", "src", $path) . '.php';

//     var_dump($path);
//     if (file_exists($path)) {

//         require_once($path);
//     }
// });

use App\Controllers\Comment\Add;
use App\Controllers\Comment\Update;
use App\Controllers\Error\ErrorPage;
use App\Controllers\HomePage;
use App\Controllers\Post;



// require_once('src/controllers/Error.php');


try {
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = (int) $_GET['id'];
                $showPost = new Post();
                $showPost->ShowPost($identifier);
            } else {
                throw new Exception('L\'identifiant n\'a pas été trouvé! ');
            }
        } elseif ($_GET['action'] === 'add_comment' && $_GET['action'] !== '') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $post_id = (int)$_GET['id'];
                (new Add())->addComment($post_id, $_POST);
            } else {
                throw new Exception("Le post n'as pas été trouvé!!");
            }
        } elseif ($_GET['action'] === 'updateComment' && $_GET['action'] !== '') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_comment = (int)$_GET['id'];
                $inputs = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $inputs = $_POST;
                }

                (new Update())->execute($id_comment, $inputs);
            } else {
                throw new Exception("Le post n'as pas été trouvé!!");
            }
        } else {
            throw new Exception('Error 404 NOT FOUND!!!');
        }
    } else {
        $homePage = new HomePage();
        $homePage->index();
    }
} catch (\Exception $e) {

    (new ErrorPage())->error($e);
}
