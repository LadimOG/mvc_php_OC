<?php
session_start();
require_once 'src/controllers/front/post.php';
require_once 'src/controllers/front/homepage.php';
require_once 'src/controllers/back/add_comment.php';

if (isset($_GET['action']) && !empty($_GET['action'])) {
    if ($_GET['action'] === 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = (int) $_GET['id'];
            post($identifier);
        } else {
            die('L\'identifiant n\'a pas été trouvé! ');
        }
    } elseif ($_GET['action'] === 'add_comment' && $_GET['action'] !== '') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {

            $post_id = (int)$_GET['id'];
            addComment($post_id, $_POST);
        } else {
            die("Le post n'as pas été trouvé!!");
        }
    } else {
        die('Error 404 NOT FOUND!!!');
    }
} else {
    homePage();
}
