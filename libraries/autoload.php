<?php

//permet de faire le lien entre toutes les classes sans nécessité de require
spl_autoload_register(function ($className) {
    $className = str_replace("\\", '/', $className);

    require_once("libraries/$className.php");
});
