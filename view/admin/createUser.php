<?php include('view/admin/redirect.php'); ?>

<div class="field button">
    <a href="index.php?controller=user&task=showUsers">
        <input type="submit" value="retour">
    </a>
</div>
<div class="card_title">
    <h1>Créer un utilisateur</h1>
</div>
<div class="user_div">

    <div class="horizontal_line">
        <form method="POST" action="index.php?controller=user&task=createUser">
            <div class="contact-input">

                <div class="add-titre user_infos">

                    <label for="edit_fname">Prénom</label>
                    <input class="edit_user" name="create_fname" require>

                    <label for="edit_lname">Nom</label>
                    <input class="edit_user" name="create_lname" require>

                    <label for="edit_email">Email</label>
                    <input class="edit_user" type="email" name="create_email" require>

                    <label for="edit_adress">Adresse</label>
                    <input class="edit_user" name="create_adress" require>

                    <label for="edit_city">Ville</label>
                    <input class="edit_user" name="create_city" require>

                    <label for="edit_zip_code">Code Postal</label>
                    <input class="edit_user" name="create_zip_code" require>

                    <div class="add-category">
                        <label for="edit_role">Catégorie:</label>
                        <select class="edit_user" name="create_role">
                            <option value="2" selected>Utilisateur</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>

                </div>

                <div class="field button">
                    <input class="edit_btn_user" name="add_book" type="submit" value="Créer" onclick="return window.confirm('Êtes vous sûr de vouloir enregistrer ces modifications ?')">
                </div>

            </div>
        </form>
    </div>
</div>