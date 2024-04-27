<?php $title = "Modification de commentaire" ?>

<?php ob_start() ?>
<h1>Modification</h1>


<div class="update-form">
    <p><a href="index.php?action=post&id=<?= $comment->getPostId() ?>">retour au post</a></p>
    <form action="index.php?action=updateComment&id=<?= $comment->getId() ?>" method="post">
        <div class="author">
            <label for="author">Auteur:</label>
            <input type="text" id="author" name="author" value="<?= $comment->getAuthor() ?>">
        </div>
        <div class="comment">
            <label for="comment">Commentaire:</label>
            <textarea name="comment" id="comment"><?= $comment->getComment() ?></textarea>
        </div>
        <input type="submit" name="submit" value="Modifier">
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php') ?>