<?php
function gestionError($e)
{

    $messageError = null;

    if (isset($e)) {
        $messageError = $e->getMessage();
        require('templates/error.php');
    }
}
