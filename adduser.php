<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
include('style.php');
session_start();
include('logincheck.php');
echo "<style>td {white-space: nowrap;} .font-md {font-size:12px}</style>";
echo "<body style='background:rgba(0,0,0,0)'>";

if(!isset($_POST['username'])){
    
}else{
    $username=$_POST['username'];
    $email=$username.'@'.$domain;
    $maildir=$email.'/';
}

if(!isset($_POST['password'])){
    
}else{
    $password=$_POST['password'];
}

if(!isset($_POST['name'])){
    
}else{
    $name=$_POST['name'];
}

if(!isset($_POST['admin'])){
    
}else{
    $admin=$_POST['admin'];
}

$quota_type=1024*1024;

if($_POST['quota']==''){
    $quota=0;
}else{
    $quota=$_POST['quota'];
}

$quota_size=$quota*$quota_type;

echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<form method='post'>";
echo "<table align='center' style='margin-top:20vh;text-align:center;width:100%' class='table font-md'>";
echo "<thead>";
echo "<tr><th class='col-lg-2'>Full Name</th><th class='col-lg-2'>Username</th><th class='col-lg-2'>Password</th><th>Admin</th><th class='col-lg-2'>Quota</th></tr>";
echo "</thead>";
echo "<tbody class='align-middle'>";
echo "<tr><td ><input type='text' name='name' placeholder='Full Name' class='form-control font-md text-center' autofocus></td><td><input type='text' name='username' placeholder='Username' class='form-control font-md text-center'></td><td><input type='password' name='password' placeholder='Password' class='form-control font-md text-center'></td><td><select name='admin' class='form-control font-md text-center'><option value=0>No</option><option value=1>Yes</option></select></td><td><input type='number' min=1 name='quota' placeholder='Mailbox Size' class='form-control font-md text-center'></td><td>MB</td></tr></tbody></table>";
echo "<table align='center' width='200px'><tr><td><input type='submit' name='submit' value='ADD' class='btn btn-secondary font-md' style='width:100%'></td></tr>";
echo "</table></form>";
echo "</div>";
echo "</div>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";

if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && ($_POST['username']=='' || $_POST['password']=='' || $_POST['name']=='' || $_POST['quota']=='')){
    echo "<table style='background:pink' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}else{
    $output=shell_exec("python3 adduser.py '".$email."' '".$password."' '".$name."' '".$admin."' '".$maildir."' '".$quota_size."' '".$username."' '".$domain."' '".$database."'");
    echo $output;
    echo "<table style='background:lightgreen' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid green;color:green'>New user has been added successfully!</td></tr></table>";
   }

?>