<?php

namespace App\Models\Comment;

use App\Lib\Database;

class CommentRepository extends Database
{


    public function createComment($author, $comment, $post_id): bool
    {

        $statement = parent::$connection->prepare('INSERT INTO comments (post_id, author, comment,comment_date) VALUES (:id, :author, :comment, NOW())');

        $success = $statement->execute([
            "id" => $post_id,
            "author" => $author,
            "comment" => $comment

        ]);

        return $success;
    }

    public function getComments(int $id): array
    {


        $statement = parent::$connection->prepare('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, "%d/%m/%Y à %Hh%imin%s") as comment_date_fr FROM comments WHERE post_id = :id ORDER BY comment_date DESC');
        $statement->execute([
            'id' => $id
        ]);

        $comments = [];
        while ($row = $statement->fetch()) {

            $comments[] = new Comment($row['id'], $row['author'], $row['comment'], $row['comment_date_fr'], $row['post_id']);
        }
        return $comments;
    }

    public function getComment(int $id): Comment
    {
        $statement = parent::$connection->prepare('SELECT *, DATE_FORMAT(comment_date, "%d/%m/%Y à %Hh%imin%s") as comment_date_fr FROM comments WHERE id = :id');
        $statement->execute([
            'id' => $id
        ]);


        while ($row = $statement->fetch()) {
            return new Comment($row['id'], $row['author'], $row['comment'], $row['comment_date_fr'], $row['post_id']);
        }

        return null;
    }

    public function update($author, $comment, $identifier): bool
    {
        $statement = parent::$connection->prepare('UPDATE comments SET author = :author, comment = :comment WHERE id = :id');

        $success = $statement->execute([
            'author' => $author,
            'comment' => $comment,
            'id' => $identifier
        ]);

        return ($success > 0);
    }
}
