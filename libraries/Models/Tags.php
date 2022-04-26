<?php

namespace Models;

class Tags extends Model
{
    protected $table = "tags";


    public function selectTags()
    {
        $stmt1 = $this->pdo->query("SELECT * from {$this->table}");
        $tags = $stmt1->fetchAll();

        return $tags;
    }
}
