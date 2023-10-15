<?php
    session_start();
    # If id is present retrives array and unsets it, then empty array
    if( !empty($_GET['id']) ){
        $favorites = $_SESSION["favorites"];
        unset($favorites[array_search($_GET["id"], $favorites)]);
        $_SESSION["favorites"] = $favorites;
    } else{
        $_SESSION["favorites"] = [];
    }
    # Checks if name is present and if not its sets to empty
    if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) )
        $str = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
    else
        $str = "";

    # Redirect
    header("Location: favPage.php?$str");
?>