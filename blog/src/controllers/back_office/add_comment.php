<?php

namespace App\Controllers\Back_office;

require_once('src/models/comment/comment.php');
require_once('src/lib/database.php');

use App\Models\Comment\Comment\CommentRepository;
use App\Lib\Database\DatabaseConnection;

class AddComment
{
    public string $author;
    public string $comment;

    public function addComment(int $id_post, array $inputs)
    {

        if (!empty($inputs['pseudo']) && !empty($inputs['comment'])) {
            $this->author = $inputs['pseudo'];
            $this->comment = $inputs['comment'];
        } else {
            throw new \Exception('Veuillez bien remplir les champs');
        }

        $createComment = new CommentRepository();
        $createComment->connection = new DatabaseConnection();
        $success =  $createComment->createComment($this->author, $this->comment, $id_post);

        if ($success) {
            header("Location: index.php?action=post&id={$id_post}");
        } else {
            throw new \Exception('Votre commentaire n\'a pas été ajouté');
        }
    }
}
