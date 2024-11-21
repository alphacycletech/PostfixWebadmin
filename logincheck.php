<?php

if(!isset($_SESSION['login']) || $_SESSION['login']!=$_GET['token']){
    session_unset();
    header('Location:index.php');
}

?>