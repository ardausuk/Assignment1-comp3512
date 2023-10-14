<?php
       session_start();

       if( !isset($_SESSION["favorites"]) ){
           $_SESSION["favorites"] = [];
       }
   
       $favorites = $_SESSION["favorites"];
   
       if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) )
           $str = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
       else
           $str = "";
   
   $isInFavorites = array_search($_GET["id"], $favorites);
   if($isInFavorites !== false) {
       $message = "Song already in favorites";
       header("Location: favPage.php?text=$message&$str");
   } else {
       $favorites[] = $_GET["id"];
       $_SESSION["favorites"] = $favorites;
   
       header("Location: favPage.php?$str");
   }
?>