<?php
require 'src/controllers/controller_post.php';
require 'src/controllers/controller_homepage.php';

if(isset($_GET['action']) && !empty($_GET['action'])){
    if($_GET['action'] === 'post'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $identifier = (int) $_GET['id'];
            post($identifier);
        }else{
            die('L\'identifiant n\'a pas été trouvé! ');
        }

    }else{
        die('Error 404 NOT FOUND!!!');
    }

}else{
    homePage();
}
