<?php

class Post
{
  public int $id;
  public string $title;
  public string $content;
  public string $frenchCreationDate;
}

class PostRepository
{
  public ?PDO $database = null;

  function getPosts(): array
  {
    // Connexion à la base de données
    $this->dbConnect();

    // On récupère les 5 derniers billets
    $statement = $this->database->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    $posts = [];

    while ($row = $statement->fetch()) {
      $post = new Post();
      $post->id = $row['id'];
      $post->title = $row['title'];
      $post->content = $row['content'];
      $post->frenchCreationDate = $row['french_creation_date'];

      $posts[] = $post;
    }
    return $posts;
  }

  public function getPost(int $id): Post
  {

    $this->dbConnect();
    $statement = $this->database->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%s") as creation_date_fr FROM posts WHERE id = :id');

    $statement->execute([
      'id' => $id
    ]);

    while ($row = $statement->fetch()) {

      $post = new Post();
      $post->id = $row['id'];
      $post->title = $row['title'];
      $post->content = $row['content'];
      $post->frenchCreationDate = $row['creation_date_fr'];


      return $post;
    }
  }

  public function dbConnect()
  {
    if ($this->database === null) {
      $this->database =  new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]);
    }
  }
}
