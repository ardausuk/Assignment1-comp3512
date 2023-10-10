<?php
class DatabaseHelper {
    /*  Returns a connection object to a database  */
public static function createConnection( $values=array() ) { $connString = $values[0];
$user = $values[1];
$password = $values[2];
$pdo = new PDO($connString,$user,$password); $pdo->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION); $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
PDO::FETCH_ASSOC); return $pdo;
}
    /*
     Runs the specified SQL query using the passed connection and
     the passed array of parameters (null if none)
*/
public static function runQuery($connection, $sql, $parameters) { $statement = null;
        // if there are parameters then do a prepared statement
if (isset($parameters)) {
          // Ensure parameters are in an array
if (!is_array($parameters)) {
$parameters = array($parameters);
 }
          // Use a prepared statement if parameters
$statement = $connection->prepare($sql); $executedOk = $statement->execute($parameters); if (! $executedOk) throw new PDOException;
} else {
          // Execute a normal query
$statement = $connection->query($sql);
if (!$statement) throw new PDOException; }
return $statement;
 }
}
# Artist class with the functions needed for the artist table within the DB
class ArtistsDB{
    private static $baseSQL = "SELECT artist_id, artist_name FROM artists";

    public function __construct($connection){
        $this->pdo = $connection; }

    # The function below gets all artists from the DB and orders them by name
    public function getAll(){
        $sql = self::$baseSQL . " ORDER BY artist_name";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    # The function below gets the top 10 artists based on number of songs
    public function getTopArtists(){
        $sql = "SELECT artist_name AS name, COUNT(artists.artist_id) AS num FROM artists INNER JOIN songs ON artists.artist_id=songs.artist_id GROUP BY artists.artist_id ORDER BY num DESC LIMIT 10";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    # The function below returns a specific artist based on the artist_id
    public function getArtist($artist_id){
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artist_id));
        return $statement->fetchAll();
    }
    }
# Genre class with the functions needed for the genre tables within the DB
class GenresDB{
    private static $baseSQL = "SELECT genre_id, genre_name FROM genres"

    public function __construct($connection){
        $this->pdo = $connection; }

    # The function below gets all genres from the DB and orders them by their name
    public function getAll(){
        $sql = self::$baseSQL . " ORDER BY genre_name";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }    
    # The function below gets the top 10 genres based on the number of songs in that genre
    public function getTopGenres(){
        $sql = "SELECT COUNT(songs.genre_id) AS num, genre_name AS name FROM songs INNER JOIN genres ON songs.genre_id = genres.genre_id GROUP BY songs.genre_id ORDER BY num DESC LIMIT 10";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    # The function below returns a specific artist based on the genre_id
    public function getGenre($genre_id){
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($genre_id));
        return $statement->fetchAll();
    }

}

class SongsDB{
    private static $baseSQL = "SELECT song_id, bpm, energy, danceability, liveness, valence, acousticness, speechiness, popularity, title, duration, artist_name, year, genre_name, popularity,type_name FROM artists INNER JOIN songs ON songs.artist_id = artists.artist_id INNER JOIN genres ON songs.genre_id = genres.genre_id INNER JOIN types ON artists.artist_type_id=types.type_id";
    
    public function __construct($connection){
        $this -> pdo = $connection; }
        /**
         * One-hit wonders: the most popular songs by artists with only a single song in the database. It will also require a calculated column. Sort them by popularity
         * Longest Acoustic Song: Select only those songs whose acousticness value is above 40. Sort them by duration 
         * At the Club: Select only those songs whose danceability value is above 80. A song’s suitability for the club is based on the calculation: danceability*1.6 + energy*1.4. The list should be sorted based on the calculation in descending order. 
         * Running Songs: Select only those songs whose bpm value is between 120-125. A song’s suitability for running is based on the calculation: energy*1.3 + valence*1.6. The list should be sorted based on the calculation in descending order.
         * Studying: select only those songs whose bpm value is between 100-115 and whose speechiness is between 1-20. A song’s suitability for studying is based on the calculation: (acousticness*0.8)+(100-speechiness)+(100-valence). The list should be sorted based on the calculation in descending order
         */

}

# Type class with the functions needed for the type tables within the DB
class TypesDB{
    private static $baseSQL = "SELECT type_id, type_name FROM types";

    public function __construct($connection){
        $this -> pdo = $connection; }
    
    # The function below gets all types from the DB and orders by their name
   public function getAll(){
        $sql = self::$baseSQL . " ORDER BY genre_name";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }    
}





?>