<?php
require_once 'includes/config.inc.php';
require_once 'includes/db-classes.inc.php';
require_once 'includes/homePage-helper.inc.php';
require_once 'includes/singlePage-helper.inc.php';

try{
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $songGet = new SongsDB($conn);

    if( !empty($_GET['id']) ){
        $song = $songGet->getSong($_GET['id']);
    }
}
catch (Exception $e){ die($e->getMessage());}   

?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarmonyHub</title>
    <link rel="stylesheet" href="css/single.css">
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

<h1>Song Information</h1>
<main>
<div class="song-info-container">
        <?php
        foreach ($song as $songName) {
            echo "<div class='song-info'>";
            echo "<span class='song-info-label'>Song Title:</span> <span class='song-info-value'>" . $songName['title'] . "</span><br>";
            echo "<span class='song-info-label'>Artist:</span> <span class='song-info-value'>" . $songName['artist_name'] . "</span><br>";
            echo "<span class='song-info-label'>Artist Type:</span> <span class='song-info-value'>" . $songName['type_name'] . "</span><br>";
            echo "<span class='song-info-label'>Genre:</span> <span class='song-info-value'>" . $songName['genre_name'] . "</span><br>";
            echo "<span class='song-info-label'>Year:</span> <span class='song-info-value'>" . $songName['year'] . "</span><br>";
            echo "<span class='song-info-label'>Duration:</span> <span class='song-info-value'>";
            timeFormat($songName['duration']);
            echo " min</span><br>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="additional-info-container">
        <ul class='additional-info'>
            <?php
            foreach ($song as $songName) {
                echo "<li>BPM: <span class='green'>" . $songName['bpm'] . "</span></li>";
                echo "<li>Energy: <span class='green'>" . $songName['energy'] . "</span></li>";
                echo "<li>Liveness: <span class='green'>" . $songName['liveness'] . "</span></li>";
                echo "<li>Danceability: <span class='green'>" . $songName['danceability'] . "</span></li>";
                echo "<li>Valence: <span class='green'>" . $songName['valence'] . "</span></li>";
                echo "<li>Acousticness: <span class='green'>" . $songName['acousticness'] . "</span></li>";
                echo "<li>Popularity: <span class='green'>" . $songName['popularity'] . "</span></li>";
            }
            ?>
        </ul>
    </div>
<br><br>
    <img src='img/gif7.gif' />

</main>


<footer>
<p>COMP 3512 Assignment 1</p>
        <p>&copy; 2023 Arda Usuk. All Rights Reserved.</p>
        <p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>
     
</footer>
</body>
</html>