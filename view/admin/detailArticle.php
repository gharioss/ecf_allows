<?php include('view/admin/redirect.php'); ?>

<div class="field button">
    <a href="index.php?controller=articles&task=getAllArticle">
        <input type="submit" value="retour">
    </a>
</div>
<div class="card_title">
    <h1>Modificier cet article</h1>
</div>
<form method="POST" action="index.php?controller=articles&task=editThisArticle&id=<?= $detailArticles[0]['id_article']; ?>">
    <div class="contact-input">

        <div class="add-titre">

            <img style="margin-bottom: 15px;" class="list_image" src="<?= $detailArticles[0]['img']; ?>" />


            <label for="article_edit_title">Titre</label>
            <input class="edit_user" name="article_edit_title" value="<?= $detailArticles[0]['title']  ?>" require>

            <label for="article_edit_lname">Nom</label>
            <input class="edit_user" name="article_edit_lname" value="<?= $detailArticles[0]['lname']  ?>" require>

            <label for="article_edit_fname">Prénom</label>
            <input class="edit_user" name="article_edit_fname" value="<?= $detailArticles[0]['fname']  ?>" require>

            <p>Date d'enregistrement : <?= $detailArticles[0]['date_put'] ?></p>


            <div class="add-category">
                <label for="add_category">Genres:</label>
                <select name="add_tags">
                    <?php foreach ($allTags as $tags) : ?>
                        <option value="<?= $tags['id_tags']; ?>"><?= $tags['tags']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <!-- ?php for ($i = 0; $i < sizeof($detailArticles); $i++) : ?>
                ?php if ($tags['tags'] != $detailArticles[$i]['tags']) : ?>

                    <input type="checkbox1" name="chkl[ ]" value="?= $tags['id_tags']; ?>">
                    <label for="scales">?= $tags['tags']; ?></label>
                ?php else : ?>

                    <input type="checkbox1" name="chkl[ ]" value="?= $tags['id_tags']; ?>" checked>
                    <label for="scales">?= $tags['tags']; ?></label>

                ?php endif; ?>

            ?php endfor; ?> -->

            <label for="article_edit_content">Contenu</label>
            <textarea class="edit_user" name="article_edit_content" rows="5" require><?= $detailArticles[0]['content']; ?></textarea>

            <label for="article_edit_edition">Edition</label>
            <input class="edit_user" name="article_edit_edition" value="<?= $detailArticles[0]['edition']; ?>" require>

            <label for="article_edit_collection">Collection</label>
            <input class="edit_user" name="article_edit_collection" value="<?= $detailArticles[0]['collection']; ?>" require>

            <div class="add-category">
                <label for="add_category">Catégorie:</label>
                <select class="edit_article_select" id="category" name="edit_category">
                    <option value="4" selected>Roman</option>
                    <option value="5">Bande Dessinée</option>
                    <option value="6">Magasine</option>
                    <option value="7">Manga</option>
                </select>
            </div>

        </div>

        <div class="field">
            <input class="edit_btn_user" name="add_book" type="submit" value="Modifier" onclick="return window.confirm('Êtes vous sûr de vouloir enregistrer ces modifications ?')">
        </div>

    </div>
</form>