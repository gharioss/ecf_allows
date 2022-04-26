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


<div class="card_title">
    <h1>Roman</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= 5; $i++) : ?>
        <?php if ($articles[$i]['id_category'] === "4") : ?>
            <li>
                <div class="card_flipper">
                    <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $articles[$i]['id_article']; ?>">
                        <div class="card_front">
                            <?php if ($articles[$i]['a_img'] == 1) : ?>
                                <img src="<?= $articles[$i]['img'] ?>" />
                            <?php endif; ?>
                            <div class="info card_title">
                            </div>
                        </div>
                        <div class="card_back">
                            <div class="info back_info">
                                <?php if ($articles[$i]['a_title'] == 1) : ?>
                                    <h3 class="subj"> <?= $articles[$i]['title']; ?></h3>
                                    <p class="line"></p>
                                <?php endif; ?>
                                <?php if ($articles[$i]['a_lname']) : ?>
                                    <p class="author"><?= $articles[$i]['fname'] . ' ' . $articles[$i]['lname']; ?></p>
                                    <p class="line"></p>
                                <?php endif; ?>
                                <p class="author"><?= $articles[$i]['tags']; ?></p>
                                <p class="line"></p>

                                <?php if ($articles[$i]['a_content'] == 1) : ?>
                                    <p class="summary">
                                        <?= $articles[$i]['content']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        <?php endif; ?>
    <?php endfor; ?>
</ul>

<hr class="header_main">

<div class="card_title">
    <h1>Bande Dessinée</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= 5; $i++) : ?>
        <?php if ($articles[$i]['id_category'] === "5") : ?>
            <li>
                <div class="card_flipper">
                    <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $articles[$i]['id_article']; ?>">
                        <div class="card_front">

                            <img src="<?= $articles[$i]['img'] ?>" />
                            <div class="info card_title">
                            </div>
                        </div>
                        <div class="card_back">
                            <div class="info back_info">
                                <?php if ($articles[$i]['a_title'] == 1) : ?>
                                    <h3 class="subj"> <?= $articles[$i]['title']; ?></h3>
                                    <p class="line"></p>
                                <?php endif; ?>
                                <?php if ($articles[$i]['a_lname']) : ?>
                                    <p class="author"><?= $articles[$i]['fname'] . ' ' . $articles[$i]['lname']; ?></p>
                                    <p class="line"></p>
                                <?php endif; ?>
                                <p class="author"><?= $articles[$i]['tags']; ?></p>
                                <p class="line"></p>

                                <?php if ($articles[$i]['a_content'] == 1) : ?>
                                    <p class="summary">
                                        <?= $articles[$i]['content']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        <?php endif; ?>
    <?php endfor; ?>
</ul>

<hr class="header_main">

<div class="card_title">
    <h1>Magazine</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= 5; $i++) : ?>
        <?php if ($articles[$i]['id_category'] === "6") : ?>
            <li>
                <div class="card_flipper">
                    <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $articles[$i]['id_article']; ?>">
                        <div class="card_front">

                            <img src="<?= $articles[$i]['img'] ?>" />
                            <div class="info card_title">
                            </div>
                        </div>
                        <div class="card_back">
                            <div class="info back_info">
                                <?php if ($articles[$i]['a_title'] == 1) : ?>
                                    <h3 class="subj"> <?= $articles[$i]['title']; ?></h3>
                                    <p class="line"></p>
                                <?php endif; ?>
                                <?php if ($articles[$i]['a_lname']) : ?>
                                    <p class="author"><?= $articles[$i]['fname'] . ' ' . $articles[$i]['lname']; ?></p>
                                    <p class="line"></p>
                                <?php endif; ?>
                                <p class="author"><?= $articles[$i]['tags']; ?></p>
                                <p class="line"></p>

                                <?php if ($articles[$i]['a_content'] == 1) : ?>
                                    <p class="summary">
                                        <?= $articles[$i]['content']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        <?php endif; ?>
    <?php endfor; ?>
</ul>

<hr class="header_main">


<div class="card_title">
    <h1>Manga</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= 5; $i++) : ?>
        <?php if ($articles[$i]['id_category'] === "7") : ?>
            <li>
                <div class="card_flipper">
                    <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $articles[$i]['id_article']; ?>">
                        <div class="card_front">

                            <img src="<?= $articles[$i]['img'] ?>" />
                            <div class="info card_title">
                            </div>
                        </div>
                        <div class="card_back">
                            <div class="info back_info">
                                <?php if ($articles[$i]['a_title'] == 1) : ?>
                                    <h3 class="subj"> <?= $articles[$i]['title']; ?></h3>
                                    <p class="line"></p>
                                <?php endif; ?>
                                <?php if ($articles[$i]['a_lname']) : ?>
                                    <p class="author"><?= $articles[$i]['fname'] . ' ' . $articles[$i]['lname']; ?></p>
                                    <p class="line"></p>
                                <?php endif; ?>
                                <p class="author"><?= $articles[$i]['tags']; ?></p>
                                <p class="line"></p>

                                <?php if ($articles[$i]['a_content'] == 1) : ?>
                                    <p class="summary">
                                        <?= $articles[$i]['content']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        <?php endif; ?>
    <?php endfor; ?>
</ul>
<script src="javascript/close.js"></script>