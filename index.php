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
<center>
<img src="images/hippo.png">
<br>
</center>


<div id ="main" class='shadow-box'><div id='content'>
    <center>
    <form action="" method="GET" name="">
        <table>
            <tr>
                <td><input type="text" name="search" placeholder="search ingredients" autocomplete="off"></td>
                <td><input type="submit" name="" value="Search"></td>
            </tr>
        </table>
    </form>
    </center>
</div></div>

<?php

    if (isset($_GET['search']) && $_GET['search'] != ''){ // checks to see if a search term is actually entered
        
        $search = trim($_GET['search']); // gets rid of whitespace and binds search term to a var

        $searched_words = explode(' ', $search); // splits up a string into an array
        
        $query_str = "SELECT * FROM recipes WHERE ";

        foreach($searched_words as $s_word){
            $query_str .= " search_words LIKE '%".$s_word."%' OR "; // appends the user searched terms onto the query string so it is like a reactive string that changes based on the searched terms
        }
        $query_str = substr($query_str, 0, strlen($query_str) - 3); // makes a sub string, starts at index 0 and removes 3 chars from length of string
        echo $query_str;
    }
    else
        echo 'no recipes found';

?>

<p align="right">
<a href='new-recipe.php'><button>Add recipe to database</button></a>
</p>

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