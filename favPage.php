<?php
require_once 'includes/config.inc.php';
require_once 'includes/db-classes.inc.php';
require_once 'includes/favPage-helper.inc.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarmonyHub</title>
    <link rel="stylesheet" href="css/fav.css">
</head>

    <header>


<div class="navbar">
    <p class="title">HarmonyHub</p>
    <ul>
    <li><a href="homePage.php">Home</a></li>
        <li><a href="searchPage.php">Search</a></li>
        <li><a href="favPage.php">Favourites</a></li>
        <li><a href="resultsPage.php">Browse</a></li>
        <li><a href="aboutPage.php">About Us</a></li>
    </ul>
</div>
</header>
<body>
<h1> Your Favourite Songs!</h1>

<main>
<?php
  
    echo "<table>";
    outputFavTable();

    echo "</table>";
    ?>

</main>
<img src="img/gif3.gif" />
<footer>
<p>COMP 3512 Assignment 1</p>
        <p>&copy; 2023 Arda Usuk. All Rights Reserved.</p>
        <p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>
     
</footer>
</body>
</html>