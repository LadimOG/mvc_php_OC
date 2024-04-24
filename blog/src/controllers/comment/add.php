<?php

namespace App\Controllers\Comment;

use App\Lib\Database;
use App\Models\Comment\CommentRepository;


class Add
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
        $createComment->connection = new Database();
        $success =  $createComment->createComment($this->author, $this->comment, $id_post);

        if ($success) {
            header("Location: index.php?action=post&id={$id_post}");
        } else {
            throw new \Exception('Votre commentaire n\'a pas été ajouté');
        }
    }
}
