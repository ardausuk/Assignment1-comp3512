<?php

# Ensures that the song title max length is 25 followed by hellip
function truncateTitle($title, $max_length = 25){
    if (strlen($title) > $max_length) {
        $title = htmlspecialchars(substr($title, 0, $max_length - 1)) . '&hellip;';
        }

    return $title;
    }

    # Function the outputs the browse table and later for results of the search 
    function outputSearchResults($songs, $name, $search){
        echo "<table>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Artist</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th>Popularity</th>";
        echo "<th>Add to Favourites</th>";
        echo "<th>View Song</th>";
        echo "</tr>";
        foreach($songs as $s){ ?>
            <tr>
            <td class='song-title'><a href='singleSong.php?id=<?= $s['song_id'] ?>'><?= truncateTitle($s['title']) ?></a></td>
                <td><?=$s['artist_name']?></td>
                <td><?=$s['year']?></td>
                <td><?=$s['genre_name']?></td>
                <td><?=$s['popularity']?></td>
                <td><a href='addFav.php?id=<?=$s['song_id']?>&name=<?=$name?>&<?=$name?>=<?=$search?>' ><button class='button'>Add</button></a></td>
                <td><a href='singleSong.php?id=<?=$s['song_id']?>' ><button class='view'>View</button></a></td>
            </tr>
        <?php }
        echo "</table>";
    } 
    # Function that outputs the genre from the search into the browse table
    function outputGenre($songs){
        foreach($songs as $songkey){
            echo "<option value='".$songkey['genre_id']."'>".$songkey['genre_name']."</option>";
        }

    }
    # Function that outputs the artist from search into the browse table
    function outputArtistList($artist){
        foreach($artist as $key){
            echo "<option value='".$key['artist_id']."'>".$key['artist_name']."</option>";
        }
    }
?>