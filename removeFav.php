<?php
    session_start();

    if( !empty($_GET['id']) ){
        $favorites = $_SESSION["favorites"];
        unset($favorites[array_search($_GET["id"], $favorites)]);
        $_SESSION["favorites"] = $favorites;
    } else{
        $_SESSION["favorites"] = [];
    }

    if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) )
        $str = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
    else
        $str = "";

    header("Location: favPage.php?$str");
?>