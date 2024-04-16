<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Post</title>
</head>
<body>
    <h1>Le super blog de l'AVBN !</h1>
    <p>post:</p>

    <div class="news">
        <h3>
            <?= $post['title'] ?>
            <em>posté le: <?= $post['frenchCreationDate'] ?> </em>
        </h3>
        <p><?= $post['content'] ?></p>
        <button><a href="index.php">Accueil</a></button>
    </div>

    <h2>commentaires:</h2>
    <?php foreach($comments as $comment): ?>
    <div class="comments">
        <h5><?= $comment['author'] ?><span class="creation-date"><em>posté le :<?= $comment['creation_date'] ?></em></span></h5>
        <p><?= $comment['comment'] ?></p>
    </div>
    <?php endforeach; ?>
    
</body>
</html>