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
    # Get data for each key from search and displays message, else if used so if user inputs title and artist then title will be displayed and so on after. 
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
     else if( !empty($_GET['yearB']) ){
         $songs = $songsGet->getBYear($_GET['yearB']);
         $message = "Showing all songs before the year " . $_GET['yearB'];
         $name = "yearB";
     }
     else if( !empty($_GET['yearA']) ){
         $songs = $songsGet->getAYear($_GET['yearA']);
         $message = "Showing all songs after the year " . $_GET['yearA'];
         $name = "yearA";
     }
     else if( !empty($_GET['popL']) ){
         $songs = $songsGet->getLowPop($_GET['popL']);
         $message = "Showing all songs with popularity less than " . $_GET['popL'];
         $name = "popL";
     }
     else if( !empty($_GET['popG']) ){
         $songs = $songsGet->getHighPop($_GET['popG']);
         $message = "Showing all songs with popularity greater than " . $_GET['popG'];
         $name = "popG";
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
# Output message and results of search
echo "<p class='title'>$message</p>";
outputSearchResults($songs, $name, $search); 
?>

</main>
<footer>
<p>COMP 3512 Assignment 1</p>
<p>Description of Assignment 1</p>
        <p>&copy; 2023 <a href="https://github.com/ardausuk">Arda Usuk</a>. All Rights Reserved.</p>
        <p>GitHub Repository: <a href="https://github.com/ardausuk/Assignment1-comp3512">HarmonyHub</a></p>
     
</footer>
</body>
</html>