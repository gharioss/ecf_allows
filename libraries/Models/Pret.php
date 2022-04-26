<?php

namespace Models;

class Pret extends Model
{
    protected $table = "pret";

    public function getHistorique()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $stmt1 = $this->pdo->prepare("SELECT * from {$this->table}
                                    LEFT JOIN articles ON pret.id_article = articles.id_article
                                    WHERE id_user = :id_user");

        $stmt1->bindParam(':id_user', $_SESSION['is_logged']);
        $stmt1->execute();
        $pret = $stmt1->fetchAll();


        return $pret;
    }
    public function getAvailable()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $stmt1 = $this->pdo->prepare("SELECT pret.id_user, pret.available, pret.id_article,pret.date_release, DATEDIFF(CURRENT_DATE(),                           date_release) AS date,
                                    articles.fname, articles.lname, articles.a_lname, articles.title, articles.a_title, articles.img, articles.a_img, articles.content, articles.a_content, articles.date_put, articles.date_update, articles.id_category, articles.available, articles.collection, articles.a_collection, articles.edition, articles.a_edition,
                                    CASE
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -1 AND 0 THEN 'C\'est votre dernier jour avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -2 AND -1 THEN 'Il vous reste 2 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -3 AND -1 THEN 'Il vous reste 3 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -4 AND -1 THEN 'Il vous reste 4 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -5 AND -1 THEN 'Il vous reste 5 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -6 AND -1 THEN 'Il vous reste 6 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -7 AND -1 THEN 'Il vous reste 7 jours avant de devoir rendre cet article...'
                                    ELSE 'Vous avez dépassé le temps imparti...'
                                    END AS 'status'
                                    FROM {$this->table}
                                    LEFT JOIN articles ON pret.id_article = articles.id_article
                                    WHERE pret.id_user = :id_user AND pret.available = 1
                                    -- ORDER BY pret.id_pret DESC
                                    ");
        $stmt1->bindParam(':id_user', $_SESSION['is_logged']);
        $stmt1->execute();
        $pret = $stmt1->fetchAll();

        return $pret;
    }

    public function returnBook($id)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $stmt1 = $this->pdo->prepare("UPDATE {$this->table} SET available = 0
                                    WHERE id_article = :id_article");
        $stmt1->bindParam(':id_article', $id);
        $stmt1->execute();

        $stmt2 = $this->pdo->prepare("UPDATE articles SET available = 1 WHERE id_article = :id_article");
        $stmt2->bindParam(':id_article', $id);
        $stmt2->execute();
    }

    public function occupedBooks()
    {
        $stmt1 = $this->pdo->prepare("SELECT pret.id_user, pret.available, pret.date_got, pret.id_article,pret.date_release, DATEDIFF(CURRENT_DATE(),                           date_release) AS date,
                                    articles.fname, articles.lname, articles.a_lname, articles.title, articles.a_title, articles.img, articles.a_img, articles.content, articles.a_content, articles.date_put, articles.date_update, articles.id_category, articles.available, articles.collection, articles.a_collection, articles.edition, articles.a_edition,
                                    users.fname as user_fname, users.lname as user_lname, users.email, users.adress, users.city, users.zip_code, users.id_role,
                                    CASE
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -1 AND 0 THEN 'C\'est le dernier jour avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -2 AND -1 THEN 'Il reste 2 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -3 AND -1 THEN 'Il reste 3 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -4 AND -1 THEN 'Il reste 4 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -5 AND -1 THEN 'Il reste 5 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -6 AND -1 THEN 'Il reste 6 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -7 AND -1 THEN 'Il reste 7 jours avant de devoir rendre cet article...'
                                    ELSE 'Temps imparti dépassé...'
                                    END AS 'status'
                                    FROM {$this->table}
                                    LEFT JOIN articles ON pret.id_article = articles.id_article
                                    LEFT JOIN users on pret.id_user = users.id_user
                                    WHERE pret.available = 1");

        $stmt1->execute();
        $pret = $stmt1->fetchAll();

        return $pret;
    }

    public function print($id)
    {
        $stmt1 = $this->pdo->prepare("SELECT pret.id_user, pret.available, DATE_FORMAT(`date_got`, '%d/%m/%Y') as date_got, DATE_FORMAT                 (date_release,'%d/%m/%Y') as date_release, pret.id_article, DATEDIFF(CURRENT_DATE(),date_release) AS date,
                                    articles.fname, articles.lname, articles.a_lname, articles.title, articles.a_title, articles.img, articles.a_img, articles.content, articles.a_content, articles.date_put, articles.date_update, articles.id_category, articles.available, articles.collection, articles.a_collection, articles.edition, articles.a_edition,
                                    users.fname as user_fname, users.lname as user_lname, users.email, users.adress, users.city, users.zip_code, users.id_role,
                                    CASE
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -1 AND 0 THEN 'C\'est le dernier jour avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -2 AND -1 THEN 'Il reste 2 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -3 AND -1 THEN 'Il reste 3 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -4 AND -1 THEN 'Il reste 4 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -5 AND -1 THEN 'Il reste 5 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -6 AND -1 THEN 'Il reste 6 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -7 AND -1 THEN 'Il reste 7 jours avant de devoir rendre cet article...'
                                    ELSE 'Temps imparti dépassé...'
                                    END AS 'status'
                                    FROM {$this->table}
                                    LEFT JOIN articles ON pret.id_article = articles.id_article
                                    LEFT JOIN users on pret.id_user = users.id_user
                                    WHERE pret.available = 1 AND pret.id_user = $id");

        $stmt1->execute();
        $pret = $stmt1->fetchAll();

        return $pret;
    }
}
