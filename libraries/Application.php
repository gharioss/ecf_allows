<?php

class Application
{
    public static function process()
    {

        //Fait appelle au fichier Acteur, et lance la function index
        //c'est la page de base (au lancement de l'appli, ca lance le fichier Acteur et la function index par defaut)
        $controllerName = 'Articles';
        $task = "index";

        //si dans mon url j'ai le mot clé "controller"
        if (!empty($_GET['controller'])) {
            //je remplace la valeur de ma variable par le mot sinifié dans l'url
            //si url = index.php?controller=comment
            //alors $controllerName = Comment
            //donc on va chercher dans le fichier Comment.php
            //ucfirst met la premiere lettre en majuscule (comment = Comment)
            $controllerName = ucfirst($_GET['controller']);
        }
        //si on a le mot clé "task" dans l'url:
        if (!empty($_GET['task'])) {
            //on remplace la valeur de task et on le met par la valeur écrite dans l'url
            //si index.php?controller=article&task=show
            //alors on cherche dans le fichier Article, la function show
            $task = $_GET['task'];
        }

        //on concat le tout, afin d'indiquer que l'on cherche dans le DOSSIER Controllers
        $controllerName = "\Controllers\\" . $controllerName;

        //controllerName = \Controllers\Article();
        //controllerName fait donc appelle a une CLASSE on peut donc faire un object de cette classe
        $controller = new $controllerName();
        //on cherche dans notre nouvelle classe la function qui est stocké dans $task (exp : show()...)
        $controller->$task();
    }
}
