<?php
session_start();
require_once 'src/controllers/front_office/post.php';
require_once 'src/controllers/front_office/homepage.php';
require_once 'src/controllers/back_office/add_comment.php';
require_once 'src/controllers/front_office/error.php';

try {
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = (int) $_GET['id'];
                post($identifier);
            } else {
                throw new Exception('L\'identifiant n\'a pas été trouvé! ');
            }
        } elseif ($_GET['action'] === 'add_comment' && $_GET['action'] !== '') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $post_id = (int)$_GET['id'];
                addComment($post_id, $_POST);
            } else {
                throw new Exception("Le post n'as pas été trouvé!!");
            }
        } else {
            throw new Exception('Error 404 NOT FOUND!!!');
        }
    } else {
        homePage();
    }
} catch (\Exception $e) {
    gestionError($e);
}
