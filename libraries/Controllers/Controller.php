<?php

namespace Controllers;

abstract class Controller
{
    public function render(string $path, array $variables = [])
    {
        extract($variables);

        ob_start();
        require_once('view/' . $path . '.php');
        $pageContent = ob_get_clean();

        require('view/template/template.php');
    }

    public function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }
}
