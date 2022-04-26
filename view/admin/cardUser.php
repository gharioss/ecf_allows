<?php include('view/admin/redirect.php'); ?>
<div class="table" id="div_table">

    <div id="button" class="field button">
        <a href="index.php?controller=user&task=showUsers">
            <input type="submit" value="retour">
        </a>
    </div>
    <?php if (isset($pretInfo[0])) : ?>
        <div id="card_title" class="card_title">
            <h1>Carte d'utilisateur de <?= $pretInfo[0]['user_fname'] . ' ' . $pretInfo[0]['user_lname']; ?></h1>
        </div>
        <table id="table">
            <tr class="sticky">
                <th>ID</th>
                <th>NOM</th>
                <th>LIVRE</th>
                <th>DATE <br /> D'EMPRUNT</th>
                <th>DATE <br /> DE RETOUR</th>
                <th>STATUS DE L'EMPRUNT</th>
            </tr>
            <?php foreach ($pretInfo as $pret) : ?>
                <?php if ($pret['status'] === 'Temps imparti dépassé...') {
                    $background = '#f44336';
                } elseif ($pret['status'] === 'C\'est le dernier jour avant de devoir rendre cet article...') {
                    $background = '#ff9800';
                } else {
                    $background = '#04AA6D';
                }
                ?>
                <tr class="nosticky">
                    <td><?= $pret['id_user']; ?></td>
                    <td><?= $pret['user_fname'] . ' ' . $pret['user_lname']; ?></td>
                    <td><?= $pret['title']; ?></td>
                    <td><?= $pret['date_got']; ?></td>
                    <td><?= $pret['date_release']; ?></td>
                    <td style="border: 1px solid <?= $background; ?>;"><?= $pret['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button id="print" class="print_li bold" style="height: auto;">
            <p class="print_p">Imprimer</p> <i class="fa-solid fa-print"></i>
        </button>
    <?php else : ?>
        <div class="card_title">
            <h1>Aucun résultat pour cet utilisateur ...</h1>
        </div>
    <?php endif; ?>
</div>

<script src="javascript/print.js"></script>