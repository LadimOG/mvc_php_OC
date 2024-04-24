<?php

namespace App\Models\Comment;

use App\Lib\Database;
use App\Models\Comment\Comment;

class CommentRepository
{
    public Database $connection;

    public function createComment($author, $comment, $post_id): bool
    {

        $statement = $this->connection->getConnect()->prepare('INSERT INTO comments (post_id, author, comment,comment_date) VALUES (:id, :author, :comment, NOW())');

        $success = $statement->execute([
            "id" => $post_id,
            "author" => $author,
            "comment" => $comment

        ]);

        return $success;
    }

    public function getComments(int $id): array
    {


        $statement = $this->connection->getConnect()->prepare('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, "%d/%m/%Y à %Hh%imin%s") as comment_date_fr FROM comments WHERE post_id = :id ORDER BY comment_date DESC');
        $statement->execute([
            'id' => $id
        ]);

        $comments = [];

        while ($row = $statement->fetch()) {

            $comment = new Comment();
            $comment->id = $row['id'];
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['comment_date_fr'];
            $comment->post_id = $row['post_id'];

            $comments[] = $comment;
        }
        return $comments;
    }

    public function getComment(int $id): array
    {
        $statement = $this->connection->getConnect()->prepare('SELECT *, DATE_FORMAT(comment_date, "%d/%m/%Y à %Hh%imin%s") as comment_date_fr FROM comments WHERE id = :id');
        $statement->execute([
            'id' => $id
        ]);

        $comments = [];
        while ($row = $statement->fetch()) {
            $comment = new Comment();
            $comment->id = $row['id'];
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['comment_date_fr'];
            $comment->post_id = $row['post_id'];

            $comments[] = $comment;
        }

        return $comments;
    }

    public function update($author, $comment, $identifier): bool
    {
        $statement = $this->connection->getConnect()->prepare('UPDATE comments SET author = :author, comment = :comment WHERE id = :id');

        $success = $statement->execute([
            'author' => $author,
            'comment' => $comment,
            'id' => $identifier
        ]);

        return ($success > 0);
    }
}
