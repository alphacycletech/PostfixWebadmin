<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
session_start();
include('config.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";

if(!isset($_POST['password'])){

}else{
    $password=$_POST['password'];
}
$user=$_GET['user'];

echo "<style>.input {height:40px;width:250px;border:1px solid lightgrey;font-size:16px;text-align:center} .submit {height:40px;background:grey;border:0px;width:100%;font-weight:bold;font-size:16px;color:white} .submit:hover {background:black} .icon-btn {color:black;font-size:150%}</style>";
echo "<form method='post'><table align='center' style='margin-top:20vh'>";
echo "<tr><td align='center' class='icon-btn'><i class='fa fa-lock'></i></td><td><input type='password' name='password' placeholder='New Password' class='input'></td></tr>";
echo "<tr><td colspan=2><input type='submit' name='submit' value='UPDATE' class='submit'></td></tr>";
echo "</table></form>";
echo "<p align='center' style='color:grey'>".$sub_title."</p>";
   
if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && $_POST['password']==''){
    echo "<table style='background:pink' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid red;color:red'>The new password cannot be blank!</td></tr></table>";
}else{
    $output=shell_exec("python3 modify.py '".$user."' '".$password."' '".$database."'");
    echo $output;
    
    echo "<table style='background:lightgreen' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid green;color:green'>The new password has been updated!</td></tr></table>";
   }

?>