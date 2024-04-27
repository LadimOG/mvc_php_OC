<?php

namespace App\Controllers\Comment;

use App\Lib\Database;
use App\Models\Comment\CommentRepository;

class Update
{
    public function execute(int $identifier, ?array $inputs)
    {
        $commentRepository = new CommentRepository();
        $comment = $commentRepository->getComment($identifier);

        if ($comment === null) {
            throw new \Exception("Le commentaire $identifier n'existe pas.");
        }
        require('templates/update_comment.php');


        if (isset($_POST['submit'])) {
            if ($inputs !== null) {
                $author = null;
                $comment = null;
                if (!empty($inputs['author']) && !empty($inputs['comment'])) {
                    $author = $inputs['author'];
                    $comment = $inputs['comment'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }

                $commentRepository = new CommentRepository();
                $success = $commentRepository->update($author, $comment, $identifier);

                if ($success) {
                    header('Location: index.php?action=updateComment&id=' . $identifier);
                } else {
                    throw new \Exception('Impossible de modifier le commentaire !');
                }
            }
        }
    }
}
