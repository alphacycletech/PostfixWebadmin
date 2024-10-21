<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
$forwarder=$_GET['cur_email'];

if(isset($_POST['submit'])){
    header('Location:listforwarder.php?domain=".$domain."');
}

echo "<style>.submit {height:40px;background:grey;border:0px;width:100%;font-weight:bold;font-size:16px;color:white} .submit:hover {background:black}</style>";

echo "<form method='post' action='listforwarder.php?domain=".$domain."'><table align='center' style='margin-top:20vh' width='200px'><tr><td><input type='submit' name='back' value='BACK' class='submit'></td></tr></table></form>";

$output=shell_exec("python3 deleteforwarder.py '".$domain."' '".$forwarder."' '".$database."'");
echo $output;

echo "<table style='background:lightgreen' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid green;color:green'>The forwarder has been deleted!</td></tr></table>";

echo "<p align='center' style='color:grey'>".$sub_title."</p>";

?>