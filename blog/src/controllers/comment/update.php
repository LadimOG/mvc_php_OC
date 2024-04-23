<?php

namespace App\Controllers\Comment\Update;

require_once('src/models/comment/comment.php');

use App\Lib\Database\DatabaseConnection;
use App\Models\Comment\Comment\CommentRepository;


class UpdateComment
{
    public function execute(int $identifier, ?array $inputs)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getComment($identifier);

        if ($comments === null) {
            throw new \Exception("Le commentaire $identifier n'existe pas.");
        }
        require('templates/update_comment.php');

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
            $commentRepository->connection = new DatabaseConnection();
            $success = $commentRepository->update($author, $comment, $identifier);

            if ($success) {
                header('Location: index.php?action=updateComment&id=' . $identifier);
            } else {
                throw new \Exception('Impossible de modifier le commentaire !');
            }
        }
    }
}
