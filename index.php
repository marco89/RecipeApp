<?php

require 'includes/database.php';
require 'includes/header.php'; ?>

<center>
    <img src="images/hippo.png">
    <br>
</center>

<center>
<!-- (A) SEARCH FORM -->
<form onsubmit="return ajsearch();">
    <h1>Recipe search</h1>
    <input type="text" id="search" required/>
    <input type="submit" value="Search"/>
  </form>
  
  <!-- (B) SEARCH RESULTS -->
  <div id="results"></div>

  <script>
    function ajsearch () {
      // (A) GET SEARCH TERM
      var data = new FormData();
      data.append("search", document.getElementById("search").value);
      data.append("ajax", 1);
     
      // (B) AJAX SEARCH REQUEST
      fetch("search.php", { method:"POST", body:data })
      .then(res => res.json()).then((results) => {
        var wrapper = document.getElementById("results");
        if (results.length > 0) {
          wrapper.innerHTML = "";
          for (let res of results) {
            let line = document.createElement("div");
            line.innerHTML = `${res["name"]} - ${res["ingredients"]}`;
            wrapper.appendChild(line);
          }
        } else { wrapper.innerHTML = "No results found"; }
      });
      return false;
    }
    </script>
</center>

<p align="center">
    <a href='new-recipe.php'><button>Add recipe to database</button></a>
</p>


<?php if (empty($recipes)) : ?>
    <p></p>

<?php $sql = "SELECT * 
        FROM recipes;"; // shows all db entries in a blog style form

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn); // checks whether db connection is working
} else {
    $recipes = mysqli_fetch_all($results, MYSQLI_ASSOC); // if it is working, displays all db entries
}
?>
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