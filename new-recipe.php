<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require 'includes/database.php';
    $sql = "INSERT INTO recipes (name, method, time)
            VALUES ('" . mysqli_escape_string($conn, $_POST['name']) . "','"
                       . mysqli_escape_string($conn, $_POST['method']) . "','"
                       . mysqli_escape_string($conn, $_POST['time']) . "')";


    $results = mysqli_query($conn, $sql);

    if ($results === false) {

        echo mysqli_error($conn);
    } else {

        $id = mysqli_insert_id($conn);
        echo "Inserted recipe with ID: $id";
    }
} else {

    $article = null;
}


?>

<?php require 'includes/header.php'; ?>

<h2>New recipe</h2>

<form method='post'>

    <div>
        <label for='name'>Name</label>
        <input name='name' id='name' placeholder='Recipe name'>
    </div>

    <div>
        <label for='ingredients'>Ingredients</label>
        <textarea name='ingredients' rows='4' cols='40' id='ingredients' placeholder='Recipe ingredients'></textarea>
    </div>

    <div>
        <label for='method'>Method</label>
        <textarea name='method' rows='4' cols='40' id='method' placeholder='Recipe method'></textarea>
    </div>

    <div>
        <label for='time'>Cooking time</label>
        <input type='time' name='time' id='time'>
    </div>

    <button>Add</button>

</form>

<?php require 'includes/footer.php'; ?>