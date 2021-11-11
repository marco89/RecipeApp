<?php

require 'includes/database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $sql = "SELECT *
            FROM recipe
            WHERE id = " . $_GET['id'];

    $results = mysqli_query($conn, $sql);

    if ($results === false) {

        echo mysqli_error($conn);
    } else {

        $recipes = mysqli_fetch_assoc($results);
    }
} else {
    $recipes = null;
}

?>

<?php require 'includes/header.php'; ?>
<?php if ($recipes === null) : ?>
    <p>No recipes found.</p>
<?php else : ?>

    <article>
        <h2><?= $recipes['name']; ?></h2>
        <p><?= $recipes['method']; ?></p>
    </article>

<?php endif; ?>
<?php require 'includes/footer.php'; ?>