<?php
session_start();
$name=$_SESSION['name'];
$user=$_SESSION['user'];
session_unset();
header('Location:index.php');

?>