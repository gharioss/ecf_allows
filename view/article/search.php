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
        <div class="custom-select" style="width:260px;">
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select id="category" name="id_autheur" style="width:220px;">
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
                <select id="category" name="id_collection" style="width:220px;">
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
                <select id="category" name="id_edition" style="width:220px;">
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
                <select id="category" name="id_category" style="width:220px;">
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
                <select id="category" name="id_tags" style="width:220px;">
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


<ul class="card_lst">

    <?php if (!isset($thisSearch[0])) : ?>
        <div class="card_title">
            <h1>Il n'y a pas de résultat...</h1>
        </div>
    <?php endif; ?>
    <?php foreach ($thisSearch as $search) : ?>
        <li>
            <div class="card_flipper">
                <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $search['id_article']; ?>">
                    <div class="card_front">

                        <?php if ($search['a_img'] == 1) : ?>
                            <img src="<?= $search['img'] ?>" />
                        <?php endif; ?>
                        <div class="info card_title">
                        </div>
                    </div>
                    <div class="card_back">
                        <div class="info back_info">
                            <?php if ($search['a_title'] == 1) : ?>
                                <h3 class="subj"> <?= $search['title']; ?></h3>
                                <p class="line"></p>
                            <?php endif; ?>
                            <?php if ($search['a_lname']) : ?>
                                <p class="author"><?= $search['fname'] . ' ' . $search['lname']; ?></p>
                                <p class="line"></p>
                            <?php endif; ?>
                            <p class="author"><?= $search['tags']; ?></p>
                            <p class="line"></p>

                            <?php if ($search['a_content'] == 1) : ?>
                                <p class="summary">
                                    <?= $search['content']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>