<?php

require 'includes/database.php';

$sql = "SELECT *
        FROM recipes;";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $recipes = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

?>

<img src="images/hippo.png">
<br>
<a href='new-recipe.php'><button>Add recipe to database</button></a>

<?php require 'includes/header.php'; ?>
<?php if (empty($recipes)) : ?>
    <p>No recipes found.</p>
<?php else : ?>

    <ul>
        <?php foreach ($recipes as $recipe) : ?>
            <li>
                <article>
                    <h2><a href="recipe.php?id=<?= $recipe['id']; ?>"><?= $recipe['name']; ?></a></h2>
                    <p><?= $recipe['ingredients']; ?></p>

                </article>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

<?php require 'includes/footer.php'; ?>