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

    # The function below gets all artists from the DB
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

    # The function below gets all genres from the DB
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
class SongsDB{}
class TypesDB{}





?>