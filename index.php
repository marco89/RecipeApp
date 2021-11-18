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
    <!-- search variable to be appended to POST request (what user searches for)-->
    <!-- the required at the end of this line will display a "please fill in this field" message if the user inputs nothing -->
    <input type="text" id="search" required/> 
    <!-- button functionality, clicking this runs ajsearch script -->
    <input type="submit" value="Search"/> 
  </form>
  
  <!-- (B) SEARCH RESULTS -->
  <!-- this will be added in once you get a response from server -->
  <div id="results"></div> 

  <script> 
    function ajsearch () {
      // (A) GET SEARCH TERM - just creates an obj thats a form 
      // FormData() sends forms through POST requests
      var data = new FormData(); 
      // getElementByID returns an element object representing the element whose id property matches the specified string
      data.append("search", document.getElementById("search").value); 
      // adds data object which is a form, ready to be filled with data
      data.append("ajax", 1);
     
      // (B) AJAX SEARCH REQUEST
      // fetch() sends POST request to server with POST and data as it's args
      fetch("search.php", { method:"POST", body:data })
      // the then() function applies to the results of fetch()
      // then() is classed a promise and it makes the script wait until the fetch() request has a response from the server
      // 'res' is the result that is returned from the server (it's a json file)
      // => is the arrow function and allows the writing of shorter functions, often on only one line
      // a json file is the way to structure and format data
      // the second then on line 44 waits for the file to be converted to a json file
      // the res functions returns the results var after converting it to a json file
      .then(res => res.json()).then((results) => { 
        //  wrapper variable has representation of id=results assigned to it from line 23
        var wrapper = document.getElementById("results");
        // only displays results if any results are found i.e. more than 0
        if (results.length > 0) {
        // puts nothing inside the wrapper variable ** wrapper is a div that is identified with 'results' ** 
        // https://www.javascripttutorial.net/javascript-dom/javascript-innerhtml/ information on .innerHTML
          wrapper.innerHTML = "";
          // iterates through each element and 
          for (let res of results) {
            // let is limited in scope so the line variable only exists within this for loop 
            // creating a div tag and inside that add the res variable
            // https://developer.mozilla.org/en-US/docs/Web/API/Document/createElement info on createElement
            let line = document.createElement("div");
            // displays the values of the results 'dict' which are the things like the name and method
            line.innerHTML = `${res["name"]} - ${res["ingredients"]}`;
            // so div is the parent and you append a child to it (in this case it adds recipeDiv for each loop)
            wrapper.appendChild(line);
          }
          // appends the str no results found to the inside of the wrapper variable
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