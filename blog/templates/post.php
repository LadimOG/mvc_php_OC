<?php $title = 'post' ?>

<?php ob_start() ?>

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


<?php foreach ($comments as $comment) : ?>

    <div class="comments">
        <h5><?= htmlspecialchars($comment['author']) ?><span class="creation-date"><em>posté le :<?= $comment['creation_date'] ?></em></span></h5>
        <p><?= htmlspecialchars($comment['comment']) ?></p>
    </div>
<?php endforeach; ?>

<div class="form">
    <form action="index.php?action=add_comment&id=<?= urldecode($post['id']) ?>" method="post">
        <div class="box-pseudo">
            <label for="pseudo">Pseudo:</label>
            <input type="text" name="pseudo" id="pseudo">
        </div>
        <div class="box-comment">
            <label for="comment">Commentaire:</label>
            <textarea name="comment" id="comment"></textarea>
        </div>
        <input type="submit" name="submit" value="poster">
    </form>
</div>

<?php $content = ob_get_clean() ?>
<?php require 'templates/layout.php' ?>