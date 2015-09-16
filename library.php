<?php
//session_start();
// set the default language of the website
if(isset($_GET["lang"]) && $_GET["lang"] != ""){ // check if get any language change parameter and change the session value
    $_SESSION["language"] = $_GET["lang"];
}
if(isset($_SESSION["language"]) && $_SESSION["language"] != ""){
    $language = $_SESSION["language"];
    include "lang/$language/$language.php"; // include the language file from the 'lang' folder
}
?>