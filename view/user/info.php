<?php include "view/account.php"; ?>
<div class="user_div">

    <div class="horizontal_line">

        <form method="POST" action="index.php?controller=user&task=editMyUser&id=<?= $userInfo[0]['id_user']; ?>">
            <div class="contact-input">

                <div class="add-titre user_infos">

                    <div style="margin-top: 0;" style="margin-bottom:15px;" class="card_title">
                        <h1>Mes informations ...</h1>
                    </div>

                    <label for="edit_fname">Prénom</label>
                    <input class="edit_user" name="edit_fname" value="<?= $userInfo[0]['fname'] ?>" require>

                    <label for="edit_lname">Nom</label>
                    <input class="edit_user" name="edit_lname" value="<?= $userInfo[0]['lname'] ?>" require>

                    <label for="edit_email">Email</label>
                    <input class="edit_user" type="email" name="edit_email" value="<?= $userInfo[0]['email'] ?>" require>

                    <label for="edit_adress">Adresse</label>
                    <input class="edit_user" name="edit_adress" value="<?= $userInfo[0]['adress'] ?>" require>

                    <label for="edit_city">Ville</label>
                    <input class="edit_user" name="edit_city" value="<?= $userInfo[0]['city'] ?>" require>

                    <label for="edit_zip_code">Code Postal</label>
                    <input class="edit_user" name="edit_zip_code" value="<?= $userInfo[0]['zip_code'] ?>" require>

                </div>

                <div class="field">
                    <input class="edit_btn_user" name="add_book" type="submit" value="Modifier" onclick="return window.confirm('Êtes vous sûr de vouloir enregistrer ces modifications ?')">
                </div>

            </div>
        </form>
    </div>
</div>


<?= $userInfo[0]['fname'] . ' ' . $userInfo[0]['lname']; ?>