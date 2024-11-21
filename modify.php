<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
include('style.php');
session_start();
include('logincheck.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
echo "<body style='background:rgba(0,0,0,0)'>";

if(!isset($_POST['password'])){

}else{
    $password=$_POST['password'];
}
$user=$_GET['user'];

echo "<style>.font-md {font-size:12px} .font-lg {font-size:30px}</style>";
echo "<form method='post'><table align='center' style='margin-top:20vh' class='font-md'>";
echo "<tr><td align='center'><i class='fa fa-lock font-lg'></i>&nbsp</td><td><input type='password' name='password' placeholder='New Password' class='form-control font-md text-center' autofocus></td></tr>";
echo "<tr><td colspan=2><input type='submit' name='submit' value='UPDATE' class='btn btn-secondary font-md' style='width:100%'></td></tr>";
echo "</table></form>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";
   
if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && $_POST['password']==''){
    echo "<table style='background:pink' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid red;color:red'>The new password cannot be blank!</td></tr></table>";
}else{
    $output=shell_exec("python3 modify.py '".$user."' '".$password."' '".$database."'");
    echo $output;
    
    echo "<table style='background:lightgreen' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid green;color:green'>The new password has been updated!</td></tr></table>";
   }

?>