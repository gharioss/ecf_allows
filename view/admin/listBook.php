<?php include('view/admin/redirect.php'); ?>

<?php if (isset($_GET['info']) && $_GET['info'] == 'editedArticle') : ?>
    <div class="warning_msg">
        <div class="warning">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>ATTENTION !</strong> Un article vient d'être supprimé !!
        </div>
    </div>
<?php elseif (isset($_GET['info']) && $_GET['info'] == 'deletedArticle') : ?>
    <div class="warning_msg">
        <div class="alert">
            <span class="closebtn alert_btn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>ATTENTION !</strong> Un article vient d'être modifié !!
        </div>
    </div>
<?php elseif (isset($_GET['info']) && $_GET['info'] == 'createdArticle') : ?>
    <div class="warning_msg">
        <div class="success">
            <span class="closebtn success_btn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>SUCCÈS !</strong> Un article vient d'être ajouté !!
        </div>
    </div>
<?php endif; ?>

<div class="table">

    <div class="field button">
        <?php include('view/template/admin.php'); ?>
    </div>
    <div class="card_title">
        <h1>Liste des articles</h1>
    </div>
    <table>
        <tr class="sticky">
            <th>IMAGE</th>
            <th>TITRE</th>
            <th>AUTEUR</th>
            <th>GENRE</th>
            <th>COLLECTION</th>
            <th>EDITION</th>
            <th>ACTIONS</th>
        </tr>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><img class="list_img" src="<?= $article['img'] ?>" /></td>
                <td><?= $article['title'] ?></td>
                <td><?= $article['lname'] . ' ' . $article['fname'] ?></td>
                <td><?= $article['tags'] ?></td>
                <td><?= $article['collection'] ?></td>
                <td><?= $article['edition'] ?></td>
                <td>
                    <a href="index.php?controller=articles&task=detailArticle&id=<?= $article['id_article']; ?>">
                        <input type="submit" class="edit_btn_user" value="Modifier">
                    </a>
                    <a href="index.php?controller=articles&task=deleteArticle&id=<?= $article['id_article']; ?>" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer ce livre ?')">
                        <input name="btnDelete" type="submit" class="delete_user" value="Supprimer">
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<script src="javascript/close.js"></script>