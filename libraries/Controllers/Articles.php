<?php

namespace Controllers;

class Articles extends Controller
{

    public function index()
    {
        $articleClass = new \Models\Articles();

        $article_genreClass = new \Models\Tags();

        $pretClass = new \Models\Pret();


        $articles = $articleClass->findAlls();

        $autheurs = $articleClass->getAutheur();

        $categorys = $articleClass->getCategory();

        $allTags = $article_genreClass->selectTags();

        $emprunt = $pretClass->getAvailable();

        $getRoman = $articleClass->getRoman('4');
        $getBd = $articleClass->getRoman('5');
        $getMagazine = $articleClass->getRoman('6');
        $getManga = $articleClass->getRoman('7');

        $getRomanRows = $articleClass->getRows('4');
        $getBdRows = $articleClass->getRows('5');
        $getMagazineRows = $articleClass->getRows('6');
        $getMangaRows = $articleClass->getRows('7');


        $pageTitle = "Articles";


        $this->render('accueil', compact('pageTitle', 'articles', 'autheurs', 'categorys', 'allTags', 'emprunt', 'getRoman', 'getBd', 'getMagazine', 'getManga', 'getRomanRows', 'getBdRows', 'getMagazineRows', 'getMangaRows'));
    }

    public function show()
    {
        $articleClass = new \Models\Articles();

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        if (!$article_id) {
            die("Il y a eu une erreur");
        }

        $article = $articleClass->details($article_id);

        $pageTitle = "Article";

        $this->render('article/article', compact('pageTitle', 'article'));
    }

    public function getBook()
    {
        $articleClass = new \Models\Articles();

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        if (!$article_id) {
            die("Il y a eu une erreur");
        }

        $article = $articleClass->update($article_id);

        $this->redirect('index.php?info=emprunted');
    }


    public function showAdd()
    {
        $article_genreClass = new \Models\Tags();

        $allTags = $article_genreClass->selectTags();

        $pageTitle = "Ajouter un article";

        $this->render('admin/addBook', compact('pageTitle', 'allTags'));
    }


    public function addRecipe()
    {

        $articleClass = new \Models\Articles();

        $fname = null;
        $lname = null;
        $genre = null;
        $title = null;
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/pics/';
        $pic_path = $dir . basename($_FILES['add_image']['name']);
        $content = null;
        $id_category = null;
        $collection = null;
        $edition = null;
        $genre = null;

        if (!empty($_POST['add_fname']) && !empty($_POST['add_lname']) && !empty($_POST['add_title']) && !empty($_POST['add_contenu']) && !empty($_POST['add_category']) && !empty($_POST['add_collection']) && !empty($_POST['add_edition']) && !empty($_POST['add_tags'])) {

            if (move_uploaded_file($_FILES['add_image']['tmp_name'], $pic_path)) {

                $fname = $_POST['add_fname'];
                $lname = $_POST['add_lname'];
                $title = $_POST['add_title'];
                $img = "pics/" . $_FILES['add_image']['name'];
                $content = $_POST['add_contenu'];
                $id_category = $_POST['add_category'];
                $collection = $_POST['add_collection'];
                $edition = $_POST['add_collection'];
                $genre = $_POST['add_tags'];


                $articleClass->insertRecipe($fname, $lname, $title, $img, $content, $id_category, $genre, $collection, $edition);


                $this->redirect('index.php?controller=articles&task=getAllArticle&info=createdArticle');
            }
        } else {
            echo "Vous devez remplir toutes les données.";
        }
    }

    public function getAllArticle()
    {

        $articleClass = new \Models\Articles();


        $articles = $articleClass->getAll();

        $pageTitle = "Tous les articles";


        $this->render('admin/listBook', compact('pageTitle', 'articles'));
    }


    public function deleteArticle()
    {
        $articleClass = new \Models\Articles();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $usersInfo = $articleClass->delete($id);

        $this->redirect('index.php?controller=articles&task=getAllArticle&info=deletedArticle');
    }

    public function editArticle()
    {
        $articleClass = new \Models\Articles();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $usersInfo = $articleClass->edit($id);

        $this->redirect('index.php?controller=articles&task=getAllArticle');
    }

    public function detailArticle()
    {
        $articleClass = new \Models\Articles();

        $article_genreClass = new \Models\Tags();


        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $detailArticles = $articleClass->getAllAndTags($id);

        $allTags = $article_genreClass->selectTags();

        $pageTitle = "Article";

        $this->render('admin/detailArticle', compact('pageTitle', 'allTags', 'detailArticles'));
    }




    public function editThisArticle()
    {

        $articleClass = new \Models\Articles();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $fname = null;
        $lname = null;
        $title = null;
        $content = null;
        $collection = null;
        $edition = null;
        $category = null;

        if (!empty($_POST['article_edit_title']) && !empty($_POST['article_edit_lname']) && !empty($_POST['article_edit_fname']) && !empty($_POST['article_edit_content']) && !empty($_POST['article_edit_edition']) && !empty($_POST['article_edit_collection'])) {

            $fname = $_POST['article_edit_fname'];
            $lname = $_POST['article_edit_lname'];
            $title = $_POST['article_edit_title'];
            $content = $_POST['article_edit_content'];
            $collection = $_POST['article_edit_collection'];
            $edition = $_POST['article_edit_edition'];
            $category = $_POST['edit_category'];


            $articleClass->fullEdit($fname, $lname, $title, $content, $category, $collection, $edition, $id);

            $this->redirect('index.php?controller=articles&task=getAllArticle&info=editedArticle');
        }
        echo "there was a pb";
    }


    public function specificSearch()
    {
        $articleClass = new \Models\Articles();

        $article_genreClass = new \Models\Tags();

        $search = null;

        if (isset($_POST['id_autheur'])) {
            $search = $_POST['id_autheur'];

            $thisSearch = $articleClass->searchAutheur($search);
        } elseif (isset($_POST['id_collection'])) {
            $search = $_POST['id_collection'];

            $thisSearch = $articleClass->searchCollection($search);
        } elseif (isset($_POST['id_edition'])) {
            $search = $_POST['id_edition'];

            $thisSearch = $articleClass->searchEdition($search);
        } elseif (isset($_POST['id_category'])) {
            $search = $_POST['id_category'];

            $thisSearch = $articleClass->searchCategory($search);
        } elseif (isset($_POST['id_tags'])) {
            $search = $_POST['id_tags'];

            $thisSearch = $articleClass->searchTags($search);
        } elseif (isset($_POST['searchValue'])) {
            $search = $_POST['searchValue'];


            $thisSearch = $articleClass->getSearch($search);
        }

        $pageTitle = "Search";



        $autheurs = $articleClass->getAutheur();

        $categorys = $articleClass->getCategory();

        $allTags = $article_genreClass->selectTags();


        $this->render('article/search', compact('pageTitle', 'thisSearch', 'autheurs', 'categorys', 'allTags'));
    }


    public function allow()
    {
        $articleClass = new \Models\Articles();


        $allows = $articleClass->getAllow();


        $pageTitle = "Articles";


        $this->render('admin/allow', compact('pageTitle', 'allows'));
    }

    public function confirmAllows()
    {
        $articleClass = new \Models\Articles();

        $auteur = null;
        $titre = null;
        $contenu = null;
        $collection = null;
        $edition = null;

        if (!empty($_POST['chkl_auteur'])) {
            $auteur = 'a_fname';
        }
        if (!empty($_POST['chkl_titre'])) {
            $titre = 'a_title';
        }
        if (!empty($_POST['chkl_contenu'])) {
            $contenu = 'a_content';
        }
        if (!empty($_POST['chkl_collection'])) {
            $collection = 'a_collection';
        }
        if (!empty($_POST['chkl_edition'])) {
            $edition = 'a_edition';
        }

        $confirmed = $articleClass->confirm($auteur, $titre, $contenu, $collection, $edition);

        $this->redirect('index.php?controller=articles&task=allow&info=changedAllows');
    }
}
