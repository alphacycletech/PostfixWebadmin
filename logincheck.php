<?php

if(!isset($_SESSION['login'])){
    session_unset();
    header('Location:index.php');
}

?>