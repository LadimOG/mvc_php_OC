<?php

namespace App\Models\Comment\Comment;

require_once 'src/lib/database.php';

use App\Lib\Database\DatabaseConnection;

class Comment
{
    public string $author;
    public string $comment;
    public string $frenchCreationDate;
}

class CommentRepository
{
    public DatabaseConnection $connection;

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
            $comment->author = $row['author'];
            $comment->comment = $row['comment'];
            $comment->frenchCreationDate = $row['comment_date_fr'];

            $comments[] = $comment;
        }
        return $comments;
    }
}
