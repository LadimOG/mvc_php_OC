<?php $title = 'home'; ?>

<?php ob_start(); ?>
<h1>Le super blog de l'AVBN !</h1>
<p>Derniers billets du blog :</p>

<?php foreach ($posts as $post) : ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post->getTitle()); ?>
            <em>le <?= $post->getFrenchCreationDate(); ?></em>
        </h3>
        <p>
            <!-- On affiche le contenu du billet -->
            <?= nl2br(htmlspecialchars($post->getContent())); ?>
            <br />
            <em><a href="index.php?action=post&id=<?= $post->getId() ?>">Commentaires</a></em>
        </p>
    </div>
<?php endforeach; ?>

<?php $content = ob_get_clean() ?>
<?php require 'templates/layout.php' ?>