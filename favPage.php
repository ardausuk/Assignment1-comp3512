<?php
# Outputs table and foreach outputs data to populate
require_once 'includes/config.inc.php';
require_once 'includes/db-classes.inc.php';
require_once 'includes/favPage-helper.inc.php';

session_start();

if( ! isset($_SESSION["favorites"]) ){
    $_SESSION["favorites"] = [];
}

$favorites = $_SESSION["favorites"];

$conn = DatabaseHelper::createConnection( array(DBCONNSTRING, DBUSER, DBPASS) );
    $songsGet = new SongsDB($conn);

    if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) )
        $str = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
    else
        $str = "";

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
<a href='removeFav.php?<?=$str?>' class='rem-button'>Remove All</a>
<main>



<?php
 
  if( !empty($_GET["text"]) ){
    echo $_GET["text"]; 
}

echo "<table>";
outputFavTable();

?>

<?php
foreach($favorites as $fav_id){
    favList($songsGet->getSong($fav_id), $str);
}

echo "</table>";
?>
</main>
<img src="img/gif3.gif" alt="spongebob listening to music" />
<<footer>
<p>COMP 3512 Assignment 1</p>
<p>Description of Assignment 1</p>
        <p>&copy; 2023 <a href="https://github.com/ardausuk">Arda Usuk</a>. All Rights Reserved.</p>
        <p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>
     
</footer>
</body>
</html>