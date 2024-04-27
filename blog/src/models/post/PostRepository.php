<?php

namespace App\Models\Post;

use App\Lib\Database;

class PostRepository extends Database
{
    public string $msg = "je suis le 42";

    public function getPosts(): array
    {
        // On récupère les 5 derniers billets
        $statement = parent::$connection->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        $posts = [];

        while ($row = $statement->fetch()) {
            $posts[] = new Post($row['id'], $row['title'], $row['content'], $row['french_creation_date']);
        }
        return $posts;
    }

    public function getPost(int $id): Post
    {

        $statement = parent::$connection->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%s") as creation_date_fr FROM posts WHERE id = :id');

        $statement->execute([
            'id' => $id
        ]);

        while ($row = $statement->fetch()) {

            return new Post($row['id'], $row['title'], $row['content'], $row['creation_date_fr']);
        }
        return null;
    }
}
