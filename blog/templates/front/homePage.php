<?php $title = 'blog'; ?>

<?php ob_start();?>
<h1>Le super blog de l'AVBN !</h1>
<p>Derniers billets du blog :</p>

<?php foreach($posts as $post):?>
<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']); ?>
        <em>le <?= $post['frenchCreationDate']; ?></em>
    </h3>
    <p>
        <!-- On affiche le contenu du billet -->
        <?= nl2br(htmlspecialchars($post['content']));?>
        <br />
        <em><a href="index.php?action=post&id=<?= urldecode($post['id']) ?>">Commentaires</a></em>
    </p>
</div>
<?php endforeach; ?> 

<?php $content = ob_get_clean() ?>
<?php require 'templates/layout.php'?>