<?php include('view/admin/redirect.php'); ?>
<?php if (isset($_GET['info']) && $_GET['info'] == 'editedUser') : ?>
    <div class="warning_msg">
        <div class="warning">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>ATTENTION !</strong> Un utilisateur vient d'être modifié !!
        </div>
    </div>
<?php elseif (isset($_GET['info']) && $_GET['info'] == 'deletedUser') : ?>
    <div class="warning_msg">
        <div class="alert">
            <span class="closebtn alert_btn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>ATTENTION !</strong> Un utilisateur vient d'être supprimé !!
        </div>
    </div>
<?php elseif (isset($_GET['info']) && $_GET['info'] == 'createdUser') : ?>
    <div class="warning_msg">
        <div class="success">
            <span class="closebtn success_btn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>SUCCÈS !</strong> Un utilisateur vient d'être ajouté !!
        </div>
    </div>
<?php endif; ?>
<div class="table">

    <div class="field button">
        <?php include('view/template/admin.php'); ?>
    </div>
    <div class="card_title">
        <h1>Liste des utilisateurs</h1>
    </div>
    <table>
        <tr class="sticky">
            <th>ID</th>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>EMAIL</th>
            <th>ADRESSE</th>
            <th>VILLE</th>
            <th>CODE-POSTAL</th>
            <th>ROLE</th>
            <th>CARTE</th>
            <th>ACTIONS</th>
        </tr>
        <?php foreach ($usersInfo as $userInfo) : ?>
            <tr>
                <td><?php echo $userInfo['id_user']; ?></td>
                <td><?php echo $userInfo['lname']; ?></td>
                <td><?php echo $userInfo['fname']; ?></td>
                <td><?php echo $userInfo['email']; ?></td>
                <td><?php echo $userInfo['adress']; ?></td>
                <td><?php echo $userInfo['city']; ?></td>
                <td><?php echo $userInfo['zip_code']; ?></td>
                <td><?php echo $userInfo['role']; ?></td>
                <td>
                    <a href="index.php?controller=pret&task=getPrinted&id=<?= $userInfo['id_user']; ?>">
                        <i class="fa-solid fa-print"></i>
                    </a>
                </td>
                <td>
                    <?php if ($userInfo['role'] != "Admin") : ?>

                        <a href="index.php?controller=user&task=getUser&id=<?= $userInfo['id_user']; ?>">
                            <input type="submit" class="edit_btn_user" value="Modifier">
                        </a>
                        <a href="index.php?controller=user&task=deleteUser&id=<?= $userInfo['id_user']; ?>" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer cet utilisateur ?')">
                            <input name="btnDelete" type="submit" class="delete_user" value="Supprimer">
                            <!-- <input name="btnDelete" type="submit" class="btnDelete" value="Supprimer"> -->
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script src="javascript/close.js"></script>