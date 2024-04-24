<?php $title = "Modification de commentaire" ?>

<?php ob_start() ?>
<h1>Modification</h1>

<?php foreach ($comments as $comment) : ?>
    <div class="update-form">
        <p><a href="index.php?action=post&id=<?= $comment->post_id ?>">retour au post</a></p>
        <form action="index.php?action=updateComment&id=<?= $comment->id ?>" method="post">
            <div class="author">
                <label for="author">Auteur:</label>
                <input type="text" id="author" name="author" value="<?= $comment->author ?>">
            </div>
            <div class="comment">
                <label for="comment">Commentaire:</label>
                <textarea name="comment" id="comment"><?= $comment->comment ?></textarea>
            </div>
            <input type="submit" name="submit" value="Modifier">
        </form>
    </div>
<?php endforeach ?>

<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php') ?>