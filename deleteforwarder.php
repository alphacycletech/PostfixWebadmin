<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
include('style.php');
session_start();
include('logincheck.php');

$forwarder=$_GET['cur_email'];

if(isset($_POST['submit'])){
    header('Location:listforwarder.php?domain=".$domain."');
}

echo "<style>.font-md {font-size:12px}</style>";
echo "<body style='background:rgba(0,0,0,0)'>";

echo "<form method='post' action='listforwarder.php?domain=".$domain."'><table style='margin-top:20vh' width='100%' class='font-md text-center'><tr><td class='col-lg-2'><input type='submit' name='back' value='BACK' class='btn btn-secondary font-md'></td></tr></table></form>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";

$output=shell_exec("python3 deleteforwarder.py '".$domain."' '".$forwarder."' '".$database."'");
echo $output;

echo "<table style='background:lightgreen' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid green;color:green'>The forwarder has been deleted!</td></tr></table>";
?>