<?php include('view/admin/redirect.php'); ?>


<div class="field button">
    <?php include('view/template/admin.php'); ?>
</div>
<div class="card_title">
    <h1>Listes des livres empruntés</h1>
</div>
<ul class="card_lst">

    <?php foreach ($emprunt as $e) :  ?>

        <?php if ($e['status'] === 'C\'est le dernier jour avant de devoir rendre cet article...') {
            $last_day = 'last_day';
        } elseif ($e['status'] === 'Temps imparti dépassé...') {
            $last_day = 'late_day';
        } else {
            $last_day = '';
        }
        ?>

        <li>
            <div class="card_flipper">
                <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $e['id_article']; ?>">
                    <div class="card_front">

                        <img src="<?= $e['img'] ?>" />
                        <div class="info card_title">
                        </div>
                    </div>
                    <div class="card_back">
                        <div class="info back_info <?= $last_day; ?>">
                            <h3 class="subj <?= $last_day; ?>"> <?= $e['title']; ?></h3>
                            <p class="line"></p>
                            <p class="author <?= $last_day; ?>">Emprunter par <?= $e['user_fname'] . ' ' . $e['user_lname'] . ' '; ?>le <?= $e['date_got']; ?></p>
                            <p class="line"></p>
                            <h3 class="status <?= $last_day; ?>">
                                <?= $e['status']; ?>
                            </h3>
                            <p class="line"></p>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>