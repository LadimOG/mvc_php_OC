<?php
  	// Connexion à la base de données
  	try
  	{
      	$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '',[
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

        ]);
  	}
  	catch(Exception $e){
        	die( 'Erreur : '.$e->getMessage()   );
  	}

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
require_once 'templates/homePage.php';
?>    
