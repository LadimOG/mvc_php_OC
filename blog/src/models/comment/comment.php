<?php
class Comment
{
    public string $author;
    public string $comment;
    public string $frenchCreationDate;
}

function createComment($author, $comment, $post_id): bool
{
    $bdd = databaseCO();
    $statement = $bdd->prepare('INSERT INTO comments (post_id, author, comment,comment_date) VALUES (:id, :author, :comment, NOW())');

    $success = $statement->execute([
        "id" => $post_id,
        "author" => $author,
        "comment" => $comment

    ]);

    return $success;
}

function getComments(int $id): array
{

    $bdd = databaseCO();
    $statement = $bdd->prepare('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, "%d/%m/%Y à %Hh%imin%s") as comment_date_fr FROM comments WHERE post_id = :id ORDER BY comment_date DESC');
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



function databaseCO()
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

    ]);
    return $bdd;
}
