<?php
 require_once 'includes/config.inc.php';
 require_once 'includes/db-classes.inc.php';
 require_once 'includes/resultsPage-helper.inc.php';

 try{
     $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
     $songsGet = new SongsDB($conn);
     $artistGet = new ArtistsDB($conn);
     $genreGet = new GenresDB($conn);

     $name="";

     if( !empty($_GET['title']) ){
         $songs = $songsGet->getTitle($_GET['title']);
         $message = "Showing all songs with '" . $_GET['title'] . "' in Title";
         $name = "title";
     }
     else if( !empty($_GET['artistList']) && $_GET['artistList'] > 0){
         $artist_data = $artistGet->getArtist($_GET['artistList']);
         $songs = $songsGet->getAllArtist($artist_data[0]['artist_name']);
         $message = "Showing all songs by " . $artist_data[0]['artist_name'];
         $name = "artistList";
     }
     else if( !empty($_GET['genreList']) && $_GET['genreList'] > 0 ){
         $genre_data = $genreGet->getGenre($_GET['genreList']);
         $songs = $songsGet->getAllGenre($genre_data[0]['genre_name']);
         $message = "Showing all " . $genre_data[0]['genre_name'] . " songs in Genre";
         $name = "genreList";
     }
     else if( !empty($_GET['year-before-value']) ){
         $songs = $songsGet->getBYear($_GET['year-before-value']);
         $message = "Showing all songs before the year " . $_GET['year-before-value'];
         $name = "year-before-value";
     }
     else if( !empty($_GET['year-after-value']) ){
         $songs = $songsGet->getAYear($_GET['year-after-value']);
         $message = "Showing all songs after the year " . $_GET['year-after-value'];
         $name = "year-after-value";
     }
     else if( !empty($_GET['pop-less-value']) ){
         $songs = $songsGet->getLowPop($_GET['pop-less-value']);
         $message = "Showing all songs with popularity less than " . $_GET['pop-less-value'];
         $name = "pop-less-value";
     }
     else if( !empty($_GET['pop-greater-value']) ){
         $songs = $songsGet->getHighPop($_GET['pop-greater-value']);
         $message = "Showing all songs with popularity greater than " . $_GET['pop-greater-value'];
         $name = "pop-greater-value";
     }
     else{
         $songs = $songsGet->showAllSongs();
         $message = "Showing all songs";
     }
     // get query strings
     $search = $_GET[$name];
 } catch(Exception $e){
     die($e->getMessage());
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarmonyHub</title>
    <link rel="stylesheet" href="css/results.css">
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
    <h1>Browse For Your Songs!</h1>
<main>
<a href='resultsPage.php' class='show-all-button'><button>Show All</button></a>
<?php
echo "<p class='title'>$message</p>";
outputSearchResults($songs, $name, $search); 
?>

</main>
<footer>
<p>COMP 3512 Assignment 1</p>
        <p>&copy; 2023 Arda Usuk. All Rights Reserved.</p>
        <p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>
     
</footer>
</body>
</html>