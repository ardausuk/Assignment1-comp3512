<?php
# Search page that takes input through form and passes it to results page to populate table
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
    <h1> Search For Your Song!</h1>
<main>
<form action="resultsPage.php" method="GET">

<div class="form-row">
    <div class="form-group form-title">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
    </div>

    <div class="form-group form-artist">
        <label for="artistList">Artist:</label>
        <select name="artistList" title="artistList">
            <option value='0'>Choose An Artist</option>
            <?=artistList($artist);?>
        </select>
    </div>
</div>

<div class="form-group form-genre">
    <label for="genreList">Genre:</label><br>
    <select name="genreList" title="genreList">
        <option value='0'>Choose A Genre</option>
        <?=genreList($song)?><br>
    </select>
</div>

<div class="form-row">
    <div class="form-group form-year">
        <label for="yearB">Year:</label>
        <label for="yearB">Before</label>
        <input type="text" id="yearB" name="yearB">

        <label for="yearA">Year: After</label>
        <input type="text" id="yearA" name="yearA">
    </div>

    <div class="form-group form-pop">
        <label for="popL">Popularity:</label>
        <label for="popL">Less</label>
        <input type="text" id="popL" name="popL">

        <label for="popG">Popularity: Greater</label>
        <input type="text" id="popG" name="popG">
    </div>
</div>

<button type="submit" class="submit-button">Search</button>
</form>
<img src="img/gif2.gif"/>
</main> 
<footer>
<p>COMP 3512 Assignment 1</p>
<p>Description of Assignment 1</p>
        <p>&copy; 2023 <a href="https://github.com/ardausuk">Arda Usuk</a>. All Rights Reserved.</p>
        <p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>
     
</footer>
</body>
</html>