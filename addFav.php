<?php
       session_start();

       # Check if the favorites array is not set in session, if not initializes an empty favorites array
       if( !isset($_SESSION["favorites"]) ){
           $_SESSION["favorites"] = [];
       }
   
       $favorites = $_SESSION["favorites"];
       # Adds name str or else empty str
       if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) )
           $str = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
       else
           $str = "";
   
    # Searches the id parameter in the favorites array
   $isInFavorites = array_search($_GET["id"], $favorites);
   if($isInFavorites !== false) {
       $message = "Song already in favorites";
       header("Location: favPage.php?text=$message&$str");
   } else {
       $favorites[] = $_GET["id"];
       $_SESSION["favorites"] = $favorites;
        
       # Redirect
       header("Location: favPage.php?$str");
   }
?>