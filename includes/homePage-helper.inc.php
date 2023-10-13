<?php
# Function to ouput top 10 for homepage
function outputTop10Category($category){
    echo "<ul class='no-bullets'>";
    foreach($category as $c){
        echo "<li><span>" . $c['name'] . "</span> with " . $c['num'] . " songs</li>";
        echo "<br>";
    }
    echo "</ul>";
}
# Function to ouput top 10 for homepage
function outputTop10Songs($song){
    echo "<ul class='no-bullets'>";
    foreach($song as $topSongs){ 
        echo '<li><span><a href="singleSong.php?id=' . $topSongs['song_id'] . '">' . $topSongs['title'] . '</a></span> by ' . $topSongs['artist_name'] . '</li>';
        echo "<br>";
    }
    echo "</ul>";
}
?>