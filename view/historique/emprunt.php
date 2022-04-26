<?php include "view/account.php"; ?>


<?php if (!isset($emprunt[0])) : ?>
    <div class="card_title">
        <h1>Vous n'avez rien emprunter actuellement ...</h1>
    </div>
<?php else : ?>
    <div class="card_title">
        <h1>Liste de mes emprunts actuels ...</h1>
    </div>
<?php endif; ?>
<ul class="card_lst">

    <?php foreach ($emprunt as $e) : ?>

        <?php if ($e['status'] === 'C\'est votre dernier jour avant de devoir rendre cet article...') {
            $last_day = 'last_day';
        } elseif ($e['status'] === 'Vous avez dépassé le temps imparti...') {
            $last_day = 'late_day';
        } else {
            $last_day = '';
        }
        ?>

        <li>
            <div class="card_flipper">

                <div class="card_front">

                    <img src="<?= $e['img'] ?>" />
                    <div class="info card_title">
                    </div>
                </div>
                <div class="card_back">
                    <div class="info back_info <?= $last_day; ?>">

                        <p class="line"></p>
                        <h3 class="status <?= $last_day; ?>">
                            <?= $e['status']; ?>
                        </h3>
                        <p class="line"></p>
                    </div>
                </div>
            </div>

            <a class="first_li render_book" href="index.php?controller=pret&task=returnThis&id=<?= $e['id_article']; ?>" onclick="return window.confirm('Êtes vous sûr de vouloir rendre ce livre ?')">Rendre ce livre ?</a>
        </li>
    <?php endforeach; ?>
</ul>