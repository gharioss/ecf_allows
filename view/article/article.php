    <div class="this_article">
        <div class="this_article_img">
            <img src="<?= $article['img']; ?>" />
        </div>
        <div class="this_article_infos">
            <?php if ($article['a_lname'] == 1) : ?>
                <h3><?= $article['fname'] . ' ' . $article['lname']; ?></h3>
            <?php endif; ?>
            <?php if ($article['a_content'] == 1) : ?>
                <p><?= $article['content'] ?></p>
            <?php endif; ?>
            <?php if (!isset($_SESSION)) {
                session_start();
            }
            if (isset($_SESSION['is_logged'])) : ?>
                <a class="first_li" href="index.php?controller=articles&task=getBook&id=<?= $article['id_article']; ?>" onclick="return window.confirm('Êtes vous sûr de vouloir réserver ce livre ?')">
                    Reserver
                </a>
            <?php endif; ?>
        </div>
    </div>