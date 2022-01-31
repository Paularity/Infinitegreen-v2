<?php

session_start();

session_unset();
session_destroy();

$BackToMyPage = $_SERVER['HTTP_REFERER'];
if(isset($BackToMyPage)) {
    header('Location: '.$BackToMyPage);
} else {
    header('Location: index.php'); // default page
}
   

?>
