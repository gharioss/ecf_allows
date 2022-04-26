<?php include "view/account.php"; ?>


<?php if (!isset($emprunt[0])) : ?>
    <div class="card_title">
        <h1>Il n'y a pas de d'historique ...</h1>
    </div>
<?php else : ?>
    <div class="card_title">
        <h1>Liste de mes historiques ...</h1>
    </div>
<?php endif; ?>
<ul class="card_lst">

    <?php foreach ($emprunt as $e) : ?>
        <li>
            <div class="card_flipper">
                <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $e['id_article']; ?>">
                    <div class="card_front">

                        <?php if ($e['a_img'] == 1) : ?>
                            <img src="<?= $e['img'] ?>" />
                        <?php endif; ?>
                        <div class="info card_title">
                        </div>
                    </div>
                    <div class="card_back">
                        <div class="info back_info">
                            <?php if ($e['a_title'] == 1) : ?>
                                <h3 class="subj"> <?= $e['title']; ?></h3>
                                <p class="line"></p>
                            <?php endif; ?>
                            <?php if ($e['a_lname']) : ?>
                                <p class="author"><?= $e['fname'] . ' ' . $e['lname']; ?></p>
                                <p class="line"></p>
                            <?php endif; ?>
                            <p class="summary">
                                <?= $e['date_got']; ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>