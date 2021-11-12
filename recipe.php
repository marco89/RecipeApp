<?php

require 'includes/database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $sql = "SELECT *
            FROM recipe
            WHERE id = " . $_GET['id']; // returns db entry which ID corresponds to

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
<a href='index.php'><button>Back to main menu</button></a>



<?php



$ret = mysqli_query($conn, "SELECT * FROM recipes
                            WHERE id= " . $_GET['id']); // need to change this number to reflect what the user inputs 


echo "<table border='1'> 
<tr>
<th>name</th>
<th>ingredients</th>
<th>method</th>
<th>time</th>
</tr>"; // creates the boxes that the returned text goes in 

while ($row = mysqli_fetch_array($ret)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['ingredients'] . "</td>";
    echo "<td>" . $row['method'] . "</td>";
    echo "<td>" . $row['time'] . "</td>";
    echo "</tr>"; // gets all the listed metrics of the recipes
}
echo "</table>";

mysqli_close($conn);

?>



<?php require 'includes/footer.php'; ?>