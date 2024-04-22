<?php $title = 'error' ?>

<?php ob_start() ?>
<div class="error-container">
    <h1>Error</h1>
    <p><?= $messageError ?> .</p>
</div>

<?php $content = ob_get_clean() ?>
<?php require('templates/layout.php') ?>