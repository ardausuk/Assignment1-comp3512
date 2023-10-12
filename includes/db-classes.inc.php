<?php
 class DatabaseHelper{
    
    public static function createConnection($values = array()){
        $connString = $values[0];
        $user = $values[1];
        $pass = $values[2];

        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }

    
    public static function runQuery($connection, $sql, $parameters){
        $statement = null;
    
        if(isset($parameters)){
            if(!is_array($parameters)){
                $parameters = array($parameters);
            }

            $statement = $connection->prepare($sql);
            $executedOk = $statement->execute($parameters);

            if(!$executedOk) throw new PDOException;
        } else{
            $statement = $connection->query($sql);
            if(!$statement) throw new PDOException;
        }

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
    private static $baseSQL = "SELECT genre_id, genre_name FROM genres";

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
    
            # Returns all songs ordered by title
            public function showAllSongs(){
                $sql = self::$baseSQL . " ORDER BY title";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
                return $statement->fetchAll();
            }
            
            # Returns song by title given
            public function getTitle($title){
                $sql = self::$baseSQL . " WHERE title LIKE ? ORDER BY title";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array('%' . $title . '%'));
                return $statement->fetchAll();
            }
            
            # Returns songs for artist by name ordered by title
            public function getArtist($artistName){
                $sql = self::$baseSQL . " WHERE artist_name=? ORDER BY title";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artistName));
                return $statement->fetchAll();
            }
            # Returns songs for genre names ordered by title
            public function getGenre($genreName){
                $sql = self::$baseSQL . " WHERE genre_name=? ORDER BY title";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($genreName));
                return $statement->fetchAll();
            }
            
            # Returns songs before year given ordered by year
            public function getBYear($year){
                $sql = self::$baseSQL . " WHERE year<? ORDER BY year";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
                return $statement->fetchAll();
            }

            # Returns songs after year given ordered by year
            public function getAYear($year){
                $sql = self::$baseSQL . " WHERE year>? ORDER BY year";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
                return $statement->fetchAll();
            }
            # Return songs with lower than given popularity ordered by popularity 
            public function getLowPop($popularity){
                $sql = self::$baseSQL . " WHERE popularity<? ORDER BY popularity";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($popularity));
                return $statement->fetchAll();
            }
    
            # Return songs with higher than given popularity ordered by popularity 
            public function getHighPop($popularity){
                $sql = self::$baseSQL . " WHERE popularity>? ORDER BY popularity";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($popularity));
                return $statement->fetchAll();
            }
    
            # Returns songs information for specific song based on songID
            public function getSong($songID){
                $sql = self::$baseSQL . " WHERE song_id=?";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($songID));
                return $statement->fetchAll();
            }
            # Returns top 10 pop songs songs 
            public function getTopPop(){
                $sql = self::$baseSQL . ' ORDER BY popularity DESC LIMIT 10';
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
                return $statement->fetchAll();
            }
            
            # Returns top 10 one hit hit wonder songs with specific sql queries
            public function getTopOne(){
                $sql = " SELECT song_id, artists.artist_name, title, popularity FROM 
                songs INNER JOIN artists ON songs.artist_id=artists.artist_id GROUP BY 
                artist_name HAVING COUNT(artist_name)=1 ORDER BY popularity DESC LIMIT 10";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
                return $statement->fetchAll();
            }

            # Returns top 10 longest acoustic songs with specific sql queries
            public function getTopLongestAcoustic(){
                $sql = "SELECT song_id, title, acousticness, duration, artist_name FROM 
                songs INNER JOIN artists ON songs.artist_id=artists.artist_id WHERE 
                acousticness>40 ORDER BY duration DESC LIMIT 10";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
                return $statement->fetchAll();
            }
    
            # Retruns top 10 club songs with specific sql queries
            public function getTopClub(){
                $sql = "SELECT song_id, title, danceability, artist_name, 
                (danceability*1.6) + (energy*1.4) AS calc FROM songs INNER JOIN 
                artists ON songs.artist_id=artists.artist_id WHERE danceability>80 
                ORDER BY calc DESC LIMIT 10";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
                return $statement->fetchAll();
            }
            
            # Returns top 10 running songs with specific sql queries
            public function getTopRun(){
                $sql = "SELECT song_id, title, bpm, artist_name, (energy*1.3) + (valence*1.6) 
                AS calc FROM songs INNER JOIN artists ON songs.artist_id=artists.artist_id WHERE 
                bpm BETWEEN 120 AND 125 ORDER BY calc DESC LIMIT 10";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
                return $statement->fetchAll();
            }
            
            # Returns top 10 studying songs with specific sql queries
            public function getTopStud(){
                $sql = "SELECT song_id, title, bpm, artist_name, speechiness, 
                (acousticness*0.8) + (100-speechiness) + (100-valence) AS calc FROM 
                songs INNER JOIN artists ON songs.artist_id=artists.artist_id WHERE 
                (bpm BETWEEN 100 AND 115) AND (speechiness BETWEEN 1 AND 20) ORDER BY 
                calc DESC LIMIT 10";
    
                $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
                return $statement->fetchAll();
            }


        }


# Type class with the functions needed for the type tables within the DB
class TypesDB{
    private static $baseSQL = "SELECT type_id, type_name FROM types";

    public function __construct($connection){
        $this -> pdo = $connection; }
    
# The function below gets all types from the DB and orders by their name
   public function getAll(){
        $sql = self::$baseSQL . " ORDER BY type_name";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }    
}





?>