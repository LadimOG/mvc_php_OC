<?php

namespace App\Controllers\Error;

class ErrorPage
{
    public function Error($e)
    {

        $messageError = null;

        if (isset($e)) {
            $messageError = $e->getMessage();
            require('templates/error.php');
        }
    }
}
