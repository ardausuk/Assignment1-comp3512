<?php
# Formatting for our fav table (almost same as browse table)
 function outputFavTable(){
    echo "<table>";
    echo "<tr>";
    echo "<th>Title</th>";
    echo "<th>Artist</th>";
    echo "<th>Year</th>";
    echo "<th>Genre</th>";
    echo "<th>Popularity</th>";
    echo "<th>Remove Song</th>";
    echo "<th>View Song</th>";
    echo "</tr>";
 }
 # outputs and redirects to fav and single song pages
 function favList($fav_id, $search){
    foreach($fav_id as $fav){?>
        <tr>
            <td class='song-title'><a href='singleSong.php?id=<?=$fav['song_id']?>'><?=$fav['title']?></a></td>
            <td><?=$fav['artist_name']?></td>
            <td><?=$fav['year']?></td>
            <td><?=$fav['genre_name']?></td>
            <td><?=$fav['popularity']?></td>
            <td><a href='singleSong.php?id=<?=$fav['song_id']?>'><button class="button">View</button></a></td>
            <td><a href='removeFav.php?id=<?=$fav['song_id']?>&<?=$search?>'><button class="button">Remove</button></a></td>
        </tr>
    <?php }   
}
?>