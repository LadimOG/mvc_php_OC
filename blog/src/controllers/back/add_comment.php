<?php
require_once('src/models/post/post.php');

function addComment(int $id_post, array $inputs)
{
    $author = null;
    $comment = null;

    if (!empty($inputs['pseudo']) && !empty($inputs['comment'])) {

        $author = $inputs['pseudo'];
        $comment = $inputs['comment'];
    } else {
        die('Veuillez bien remplir les champs');
    }

    $success =  createComment($author, $comment, $id_post);

    if ($success) {
        header("Location: index.php?action=post&id={$id_post}");
    } else {
        die('Votre commentaire n\'a pas été ajouté');
    }
}
