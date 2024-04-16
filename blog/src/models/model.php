<?php
function getPosts() :array
{
    // Connexion à la base de données
    $bdd = dbConnect();

  	// On récupère les 5 derniers billets
  	$statement = $bdd->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    $posts = [];

    while ($row = $statement->fetch())
  	{
      $post = [
        'id' => $row['id'],
        'title' => $row['title'],
        'content' => $row['content'],
        'frenchCreationDate' => $row['french_creation_date']
      ];

      $posts[] = $post;
    }
    return $posts;
}

function getPost(int $id) : array
{

  $bdd = dbConnect();
  $statement = $bdd->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, "%d/%m/%Y à %Hh%imin%s") as creation_date_fr FROM posts WHERE id = :id');

  $statement->execute([
    'id' => $id
  ]);

  while($row = $statement->fetch()){
    $post = [
      'id' => $row['id'],
      'title' => $row['title'],
      'content' => $row['content'],
      'frenchCreationDate' => $row['creation_date_fr']
    ];

    return $post;
  }
}


function getComments(int $id) 
{
 
  $bdd = dbConnect();
  $statement = $bdd->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, "%d/%m/%Y à %Hh%imin%s") as comment_date_fr FROM comments WHERE post_id = :id ORDER BY comment_date DESC');
  $statement->execute([
    'id'=> $id
  ]);

  $comments =[];

  while($row = $statement->fetch()){
    $comment = [
      'id' => $row['id'],
      'author' => $row['author'],
      'comment' => $row['comment'],
      'creation_date' => $row['comment_date_fr']

    ];
    $comments[] = $comment;
  }
  return $comments;
}

function dbConnect()
{
  try
  {
      $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '',[
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

      ]);
      return $bdd;
  }
  catch(Exception $e){
        die( 'Erreur : '.$e->getMessage()   );
  }
}