<?php

require 'includes/database.php';

$sql = "SELECT *
        FROM article
        ORDER BY published_at;";

?>

<!-- <?php require 'includes/header.php'; ?>
<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>

    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>
                    <h2><a href="article.php?id=<?= $article['id']; ?>"><?= $article['title']; ?></a></h2>
                    <p><?= $article['content']; ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>  -->

<?php require 'includes/footer.php'; ?>
