<?php
include('config.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";

session_start();
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
echo "<title>".$title."</title>";
echo "<link href='".$favicon."' rel='icon' type='image/x-icon' />";
echo "<body style='background:url(".$background.");background-attachment:fixed;background-size:cover'>";

$token=rand(0,9999999999);

if(!isset($_POST['username'])){

}else{
    $username=$_POST['username'];
}

if(!isset($_POST['password'])){
    
}else{
    $password=$_POST['password'];
}

echo "<div align='center' style='margin-top:20vh'><img src='".$logo."' width='170vw'></div>";
echo "<style>.input {height:40px;width:250px;border:1px solid lightgrey;font-size:16px;text-align:center} .submit {height:40px;background:grey;border:0px;width:100%;font-weight:bold;font-size:16px;color:white} .submit:hover {background:black} .icon-btn {color:black;font-size:150%}</style>";
echo "<form method='post'><table align='center' style='margin-top:2vh'>";
echo "<tr><td align='center' class='icon-btn'><i class='fa fa-user'></i></td><td><input type='text' name='username' placeholder='Username' class='input'></td></tr>";
echo "<tr><td align='center' class='icon-btn'><i class='fa fa-lock'></i></td><td><input type='password' name='password' placeholder='Password' class='input'></td></tr>";
echo "<tr><td colspan=2><input type='submit' name='submit' value='LOGIN' class='submit'></td></tr>";
echo "</table></form>";
echo "<p align='center' style='color:grey'>".$sub_title."</p>";
   
if(!isset($_POST['submit'])){
}else{
    $output=shell_exec("python3 login.py '".$username."' '".$username."' '".$password."' '".$domain."' '".$database."'");
    $result=explode('|',$output);
    if(strpos(strval($output),'|')!=''){
        $_SESSION['login']=$token;
        $_SESSION['name']=$result[1];
        $_SESSION['user']=$result[0];
        header('Location:home.php?token='.$token);
    }
echo "<table style='background:pink' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid red;color:red'>You've entered the wrong username or password!</td></tr></table>";
      }

echo "<style>.footer {  position: fixed;right: 0;bottom: -3%;left: 0;padding: 1rem; style='background:rgba(0,0,0,0)';text-align: center;}</style>";

echo "</body>";
echo "<footer><p class='footer'>".$footer."</p></footer>";
?>