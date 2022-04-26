<?php

namespace Models;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }


    public function findAll()
    {
        $stmt1 = $this->pdo->query("SELECT * FROM {$this->table} WHERE available = 1");

        $acteurs = $stmt1->fetchAll();
        return $acteurs;
    }
    public function findAlls()
    {
        $stmt1 = $this->pdo->query("SELECT * FROM {$this->table} LEFT JOIN tags ON articles.id_tags = tags.id_tags WHERE available = 1");

        $acteurs = $stmt1->fetchAll();
        return $acteurs;
    }
}
