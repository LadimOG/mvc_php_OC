<?php $title = $post->getTitle() ?>

<?php ob_start() ?>

<h1>Le super blog de l'AVBN !</h1>
<p>post:</p>

<div class="news">
    <h3>
        <?= $post->getTitle() ?>
        <em>posté le: <?= $post->getFrenchCreationDate() ?> </em>
    </h3>
    <p><?= $post->getContent() ?></p>
    <button><a href="index.php">Accueil</a></button>
</div>

<h2>commentaires:</h2>

<?php foreach ($comments as $comment) : ?>

    <div class="comments">
        <h5><?= htmlspecialchars($comment->getAuthor()) ?><span class="creation-date"><em>posté le :<?= $comment->getFrenchCreationDate() ?></em></span><a href="index.php?action=updateComment&id=<?= $comment->getId() ?>">(modifier)</a></h5>
        <p><?= nl2br(htmlspecialchars($comment->getComment())) ?></p>
    </div>
<?php endforeach; ?>

<div class="form">
    <form action="index.php?action=add_comment&id=<?= $post->getId() ?>" method="post">
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
<?php include 'templates/layout.php' ?>