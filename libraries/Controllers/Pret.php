<?php

namespace Controllers;

class Pret extends Controller
{

    public function index()
    {
        $pretClass = new \Models\Pret();

        $emprunt = $pretClass->getHistorique();

        $pageTitle = "Historique";

        $this->render('historique/historique', compact('pageTitle', 'emprunt'));
    }
    public function availableIndex()
    {
        $pretClass = new \Models\Pret();

        $emprunt = $pretClass->getAvailable();

        $pageTitle = "Emprunts Disponibles";

        $this->render('historique/emprunt', compact('pageTitle', 'emprunt'));
    }

    public function returnThis()
    {
        $articleClass = new \Models\Pret();

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id_pret = $_GET['id'];
        }

        if (!$id_pret) {
            die("Il y a eu une erreur");
        }

        $article = $articleClass->returnBook($id_pret);

        $this->redirect('index.php?controller=pret&task=availableIndex');
    }
    public function nonAvailable()
    {
        $articleClass = new \Models\Pret();

        $emprunt = $articleClass->occupedBooks();

        $pageTitle = "Emprunts Disponibles";

        $this->render('admin/occuped', compact('pageTitle', 'emprunt'));
    }

    public function getPrinted()
    {
        $pretClass = new \Models\Pret();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $pretInfo = $pretClass->print($id);

        $pageTitle = "Carte utilisateur";

        $this->render('admin/cardUser', compact('pageTitle', 'pretInfo'));
    }
}
