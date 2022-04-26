<?php include('view/admin/redirect.php'); ?>

<div class="field button">
    <?php include('view/template/admin.php'); ?>
</div>


<div class="warning_msg">
    <div class="alert_info">
        <span class="closebtn info_btn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>INFOS !</strong> Choissiez les champs que vous voulez que les utilisateurs ne puissent pas voir.
    </div>
</div>
<form method="POST" action="index.php?controller=articles&task=confirmAllows">
    <div class="contact-input">

        <div class="add-titre">
            <fieldset>
                <legend>Choissiez les champs : </legend>

                <div>
                    <?php if ($allows[0]['a_lname'] == 0) : ?>
                        <input type="checkbox" name="chkl_auteur" value="auteur" checked>
                        <label for="scales">Auteur</label>
                    <?php else : ?>
                        <input type="checkbox" name="chkl_auteur" value="auteur">
                        <label for="scales">Auteur</label>
                    <?php endif; ?>
                </div>
                <div>
                    <div>
                        <?php if ($allows[0]['a_title'] == 0) : ?>
                            <input type="checkbox" name="chkl_titre" value="titre" checked>
                            <label for="scales">Titre</label>
                        <?php else : ?>
                            <input type="checkbox" name="chkl_titre" value="titre">
                            <label for="scales">Titre</label>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if ($allows[0]['a_content'] == 0) : ?>
                            <input type="checkbox" name="chkl_contenu" value="contenu" checked>
                            <label for="scales">Contenu</label>
                        <?php else : ?>
                            <input type="checkbox" name="chkl_contenu" value="contenu">
                            <label for="scales">Contenu</label>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if ($allows[0]['a_collection'] == 0) : ?>
                            <input type="checkbox" name="chkl_collection" value="collection" checked>
                            <label for="scales">Collection</label>
                        <?php else : ?>
                            <input type="checkbox" name="chkl_collection" value="collection">
                            <label for="scales">Collection</label>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if ($allows[0]['a_edition'] == 0) : ?>
                            <input type="checkbox" name="chkl_edition" value="edition" checked>
                            <label for="scales">Edition</label>
                        <?php else : ?>
                            <input type="checkbox" name="chkl_edition" value="edition">
                            <label for="scales">Edition</label>
                        <?php endif; ?>
                    </div>

            </fieldset>
        </div>
        <div class="field button">
            <input name="add_book" type="submit" value="Confirmer" onclick="return window.confirm('Êtes vous sûr de vouloir ajouter ces tags ?')">
        </div>
    </div>
</form>

<script src="javascript/close.js"></script>