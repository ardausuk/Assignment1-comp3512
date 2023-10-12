<?php
require_once 'includes/config.inc.php';
require_once 'includes/homePage-helper.inc.php';
require_once 'includes/db-classes.inc.php';

try{
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $songGet = new SongsDB($conn);
    $artistGet = new ArtistsDB($conn);
    $genreGet = new GenresDB($conn);
}
catch (Exception $e){ die($e->getMessage());}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarmonyHub</title>
    <link rel="stylesheet" href="css/main.css">
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
    
<div class="below-nav">
<h1>Home Page</h1><br>
<p>COMP 3512 Assignment 1</p>
<p>Description of Assignment 1</p>
<p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>

</div>

<main>

<div class="box genre"> 
        <h3>Top Genres</h3>
        <br>
        <?php 
                $genres = $genreGet->getTopGenres();
                outputTop10Category($genres);
            ?>
    </div>

    <div class="box artist"> 
        <h3>Top Artists</h3>
        <br>

        <?php 
                $artists = $artistGet->getTopArtists();
                outputTop10Category($artists);
            ?>

    </div>

    <div class="box popular"> 
        <h3>Most Popular Songs</h3>
        <br>

        <?php
        $popular = $songGet->getTopPop();
                outputTop10Songs($popular);
                ?>
    </div>

    <div class="box hit"> 
        <h3>One Hit Wonders</h3>
        <br>

        <?php 
                $oneHit = $songGet->getTopOne();
                outputTop10Songs($oneHit);
            ?>
    </div>

    <div class="box acoustic"> 
        <h3>Longest Acoustic Songs</h3>
        <br>

        <?php
        $acou = $songGet->getTopLongestAcoustic();
             
        outputTop10Songs($acou);
    ?>
        </div>

    <div class="box club"> 
        <h3>At The Club</h3>
        <br>

        <?php 
                $club = $songGet->getTopClub();
                outputTop10Songs($club);
            ?>
    </div>

    <div class="box running"> 
        <h3>Running Songs</h3>
        <br>

        <?php 
                $run = $songGet->getTopRun();
                outputTop10Songs($run);
            ?>
    </div>

    <div class="box studying"> 
        <h3>Studying</h3>
        <br>

        <?php 
                $study = $songGet->getTopStud();
                outputTop10Songs($study);
            ?>
    </div>
</main>
<footer>
<p>COMP 3512 Assignment 1</p>
<p>Description of Assignment 1</p>
        <p>&copy; 2023 Arda Usuk. All Rights Reserved.</p>
        <p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>
     
</footer>
</body>
</html>