<?php

//création de la classe Database
class Database
{
    public static function getPdo()
    {
        $pdo =  new PDO('mysql:host=localhost;dbname=JNMediaBddLike;charset=utf8', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    }
}
