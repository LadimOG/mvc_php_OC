<?php
session_start();
require_once 'src/controllers/post.php';
require_once 'src/controllers/homepage.php';
require_once 'src/controllers/comment/add.php';
require_once 'src/controllers/error.php';
require_once 'src/controllers/comment/update.php';

use App\Controllers\Comment\Add\AddComment;
use App\Controllers\Homepage\ShowHomePage;
use App\Controllers\Post\ShowPost;
use App\Controllers\Comment\Update\UpdateComment;

try {
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = (int) $_GET['id'];
                $showPost = new ShowPost();
                $showPost->post($identifier);
            } else {
                throw new Exception('L\'identifiant n\'a pas été trouvé! ');
            }
        } elseif ($_GET['action'] === 'add_comment' && $_GET['action'] !== '') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $post_id = (int)$_GET['id'];
                (new AddComment())->addComment($post_id, $_POST);
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

                (new UpdateComment())->execute($id_comment, $inputs);
            } else {
                throw new Exception("Le post n'as pas été trouvé!!");
            }
        } else {
            throw new Exception('Error 404 NOT FOUND!!!');
        }
    } else {
        $homePage = new ShowHomePage();
        $homePage->homepage();
    }
} catch (\Exception $e) {
    gestionError($e);
}
