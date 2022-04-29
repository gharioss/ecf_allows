<div class="search_item">
    <div class="search_navbar">
        <form action="index.php?controller=articles&task=specificSearch" method="POST">
            <input class="input_search" type="text" name="searchValue" placeholder="Rechercher un auteur ou un titre..." style="width:300px;">
            <button name="search" class="search_btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>
<div class="research_items">


    <fieldset>
        <legend>Rechercher par auteur : </legend>
        <div class="custom-select">
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select name="id_autheur" style="width:220px;">
                    <?php foreach ($autheurs as $autheur) : ?>
                        <option value="<?= $autheur['fname']; ?>"><?= $autheur['fname'] . ' ' . $autheur['lname']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>

    <fieldset>
        <legend>Rechercher par collection : </legend>
        <div>
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select name="id_collection" style="width:220px;">
                    <?php foreach ($autheurs as $autheur) : ?>
                        <option value="<?= $autheur['collection']; ?>"><?= $autheur['collection']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>

    <fieldset>
        <legend>Rechercher par edition : </legend>
        <div>
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select name="id_edition" style="width:220px;">
                    <?php foreach ($autheurs as $autheur) : ?>
                        <option value="<?= $autheur['edition']; ?>"><?= $autheur['edition']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>



    <fieldset>
        <legend>Rechercher par catégorie : </legend>
        <div>
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select name="id_category" style="width:220px;">
                    <?php foreach ($categorys as $category) : ?>
                        <option value="<?= $category['id_category']; ?>"><?= $category['category_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>



    <fieldset>
        <legend>Rechercher par genre : </legend>
        <div>
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select name="id_tags" style="width:220px;">
                    <?php foreach ($allTags as $tags) : ?>
                        <option value="<?= $tags['id_tags']; ?>"><?= $tags['tags']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>
</div>


<?php foreach ($emprunt as $e) {
    $last_day = 0;
    $late_day = 0;
    if ($e['status'] === 'C\'est votre dernier jour avant de devoir rendre cet article...') {
        $last_day++;
    } elseif ($e['status'] === 'Vous avez dépassé le temps imparti...') {
        $late_day++;
    }

    if ($last_day == 1 || $late_day == 1) {
        $warningBook = 'livre';
    } else {
        $warningBook = 'livres';
    }
} ?>

<?php if (isset($last_day) && ($last_day != 0)) : ?>
    <div class="warning_msg">
        <div class="warning">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>ATTENTION!</strong> Vous avez <?= $last_day . ' ' . $warningBook; ?> à rendre demain !!
        </div>
    </div>
<?php elseif (isset($late_day) && ($late_day != 0)) : ?>
    <div class="warning_msg">
        <div class="alert">
            <span class="closebtn alert_btn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>ATTENTION!</strong> La date de rendu de <?= $late_day . ' ' . $warningBook; ?> à expiré !!
        </div>
    </div>
<?php elseif (isset($_GET['info']) && $_GET['info'] == 'emprunted') : ?>
    <div class="warning_msg">
        <div class="success">
            <span class="closebtn success_btn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Succès!</strong> Vous venez d'emprunter un livre !!
        </div>
    </div>
<?php endif; ?>

<?php
if ($getRomanRows['count'] > 4) {
    $getRomanRows['count'] == 4;
} elseif ($getBdRows['count'] > 4) {
    $getBdRows['count'] == 4;
} elseif ($getMagazineRows['count'] > 4) {
    $getMagazineRows['count'] == 4;
} elseif ($getMangaRows['count'] > 4) {
    $getMangaRows['count'] = 4;
}
?>


<div class="card_title">
    <h1>Roman</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= $getRomanRows['count'] - 1; $i++) : ?>
        <li>
            <div class="card_flipper">
                <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $getRoman[$i]['id_article']; ?>">
                    <div class="card_front">
                        <?php if ($getRoman[$i]['a_img'] == 1) : ?>
                            <img src="<?= $getRoman[$i]['img'] ?>" />
                        <?php endif; ?>
                        <div class="info card_title">
                        </div>
                    </div>
                    <div class="card_back">
                        <div class="info back_info">
                            <?php if ($getRoman[$i]['a_title'] == 1) : ?>
                                <h3 class="subj"> <?= $getRoman[$i]['title']; ?></h3>
                                <p class="line"></p>
                            <?php endif; ?>
                            <?php if ($getRoman[$i]['a_lname']) : ?>
                                <p class="author"><?= $getRoman[$i]['fname'] . ' ' . $getRoman[$i]['lname']; ?></p>
                                <p class="line"></p>
                            <?php endif; ?>
                            <p class="author"><?= $getRoman[$i]['tags']; ?></p>
                            <p class="line"></p>

                            <?php if ($getRoman[$i]['a_content'] == 1) : ?>
                                <p class="summary">
                                    <?= $getRoman[$i]['content']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endfor; ?>
</ul>

<hr class="header_main">

<div class="card_title">
    <h1>Bande Dessinée</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= $getBdRows['count'] - 1; $i++) : ?>
        <li>
            <div class="card_flipper">
                <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $getBd[$i]['id_article']; ?>">
                    <div class="card_front">

                        <img src="<?= $getBd[$i]['img'] ?>" />
                        <div class="info card_title">
                        </div>
                    </div>
                    <div class="card_back">
                        <div class="info back_info">
                            <?php if ($getBd[$i]['a_title'] == 1) : ?>
                                <h3 class="subj"> <?= $getBd[$i]['title']; ?></h3>
                                <p class="line"></p>
                            <?php endif; ?>
                            <?php if ($getBd[$i]['a_lname']) : ?>
                                <p class="author"><?= $getBd[$i]['fname'] . ' ' . $getBd[$i]['lname']; ?></p>
                                <p class="line"></p>
                            <?php endif; ?>
                            <p class="author"><?= $getBd[$i]['tags']; ?></p>
                            <p class="line"></p>

                            <?php if ($getBd[$i]['a_content'] == 1) : ?>
                                <p class="summary">
                                    <?= $getBd[$i]['content']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endfor; ?>
</ul>

<hr class="header_main">

<div class="card_title">
    <h1>Magazine</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= $getMagazineRows['count'] - 1; $i++) : ?>
        <li>
            <div class="card_flipper">
                <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $getMagazine[$i]['id_article']; ?>">
                    <div class="card_front">

                        <img src="<?= $getMagazine[$i]['img'] ?>" />
                        <div class="info card_title">
                        </div>
                    </div>
                    <div class="card_back">
                        <div class="info back_info">
                            <?php if ($getMagazine[$i]['a_title'] == 1) : ?>
                                <h3 class="subj"> <?= $getMagazine[$i]['title']; ?></h3>
                                <p class="line"></p>
                            <?php endif; ?>
                            <?php if ($getMagazine[$i]['a_lname']) : ?>
                                <p class="author"><?= $getMagazine[$i]['fname'] . ' ' . $getMagazine[$i]['lname']; ?></p>
                                <p class="line"></p>
                            <?php endif; ?>
                            <p class="author"><?= $getMagazine[$i]['tags']; ?></p>
                            <p class="line"></p>

                            <?php if ($getMagazine[$i]['a_content'] == 1) : ?>
                                <p class="summary">
                                    <?= $getMagazine[$i]['content']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endfor; ?>
</ul>

<hr class="header_main">


<div class="card_title">
    <h1>Manga</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= $getMangaRows['count'] - 1; $i++) : ?>
        <li>
            <div class="card_flipper">
                <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $getManga[$i]['id_article']; ?>">
                    <div class="card_front">

                        <img src="<?= $getManga[$i]['img'] ?>" />
                        <div class="info card_title">
                        </div>
                    </div>
                    <div class="card_back">
                        <div class="info back_info">
                            <?php if ($getManga[$i]['a_title'] == 1) : ?>
                                <h3 class="subj"> <?= $getManga[$i]['title']; ?></h3>
                                <p class="line"></p>
                            <?php endif; ?>
                            <?php if ($getManga[$i]['a_lname']) : ?>
                                <p class="author"><?= $getManga[$i]['fname'] . ' ' . $getManga[$i]['lname']; ?></p>
                                <p class="line"></p>
                            <?php endif; ?>
                            <p class="author"><?= $getManga[$i]['tags']; ?></p>
                            <p class="line"></p>

                            <?php if ($getManga[$i]['a_content'] == 1) : ?>
                                <p class="summary">
                                    <?= $getManga[$i]['content']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endfor; ?>
</ul>
<script src="javascript/close.js"></script>