<?php
require_once 'includes/db-classes.inc.php';
require_once 'includes/config.inc.php';
require_once 'includes/resultsPage-helper.inc.php';
try{
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $songGet = new GenresDB($conn);
    $artistGet = new ArtistsDB($conn);
    $song = $songGet->getAll();
    $artist = $artistGet->getAll();
}
catch (Exception $e){ die($e->getMessage());}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarmonyHub</title>
    <link rel="stylesheet" href="css/search.css">
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
    <h1> Search For Your Favourite Song</h1>
<main>
<form action="resultsPage.php" method="GET">

<div class="form-row">
    <div class="form-group form-title">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
    </div>

    <div class="form-group form-artist">
        <label for="outputArtistList">Artist:</label>
        <select name="outputArtistList" id="outputArtistList">
            <option value='0'>Choose An Artist</option>
            <?=outputArtistList($artist);?>
        </select>
    </div>
</div>

<div class="form-group form-genre">
    <label for="outputGenre">Genre:</label><br>
    <select name="outputGenre" id="outputGenre">
        <option value='0'>Choose A Genre</option>
        <?=outputGenre($song)?><br>
    </select>
</div>

<div class="form-row">
    <div class="form-group form-year">
        <label for="year-before">Year:</label>
        <label for="year-before-value">Before</label>
        <input type="text" id="year-before-value" name="year-before-value">

        <label for="year-after-value">Year: After</label>
        <input type="text" id="year-after-value" name="year-after-value">
    </div>

    <div class="form-group form-pop">
        <label for="pop-less">Popularity:</label>
        <label for="pop-less-value">Less</label>
        <input type="text" id="pop-less-value" name="pop-less-value">

        <label for="pop-greater-value">Popularity: Greater</label>
        <input type="text" id="pop-greater-value" name="pop-greater-value">
    </div>
</div>

<button type="submit" class="submit-button">Search</button>
</form>
<img src="img/gif2.gif"/>
</main> 
<footer>
<p>COMP 3512 Assignment 1</p>
        <p>&copy; 2023 Arda Usuk. All Rights Reserved.</p>
        <p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>
     
</footer>
</body>
</html>