<?php

require 'includes/database.php';

$sql = "SELECT *
        FROM recipes
        ORDER BY time;";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $recipes = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

?>

<?php require 'includes/header.php'; ?>
<?php if (empty($recipes)) : ?>
    <p>No recipes found.</p>
<?php else : ?>

    <ul>
        <?php foreach ($recipes as $recipe) : ?>
            <li>
                <article>
                    <h2><a href="recipe.php?id=<?= $recipe['id']; ?>"><?= $recipe['name']; ?></a></h2>
                    <p><?= $recipe['method']; ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?> 

<?php require 'includes/footer.php'; ?>
