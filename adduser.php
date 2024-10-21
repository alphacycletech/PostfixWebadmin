<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');

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

echo "<style>.input {height:40px;width:200px;border:1px solid lightgrey;font-size:16px;text-align:center} .input2 {height:40px;width:80px;border:1px solid lightgrey;font-size:16px;text-align:center} .submit {height:40px;background:grey;border:0px;width:100%;font-weight:bold;font-size:16px;color:white} .submit:hover {background:black} select {text-align-last:center}</style>";
echo "<form method='post'><table align='center' style='margin-top:20vh'>";
echo "<tr><th>Full Name</th><th>Username</th><th>Password</th><th>Admin</th><th colspan=2>Quota</th></tr>";
echo "<tr><td ><input type='text' name='name' placeholder='Full Name' class='input'></td><td><input type='text' name='username' placeholder='Username' class='input'></td><td><input type='password' name='password' placeholder='Password' class='input'></td><td><select name='admin' class='input2'><option value=0>No</option><option value=1>Yes</option></select></td><td><input type='number' min=1 name='quota' placeholder='Mailbox Size' class='input'></td><td>MB</td></tr></table>";
echo "<table align='center' width='200px'><tr><td><input type='submit' name='submit' value='ADD' class='submit'></td></tr>";
echo "</table></form>";
echo "<p align='center' style='color:grey'>".$sub_title."</p>";

if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && ($_POST['username']=='' || $_POST['password']=='' || $_POST['name']=='' || $_POST['quota']=='')){
    echo "<table style='background:pink' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}else{
    $output=shell_exec("python3 adduser.py '".$email."' '".$password."' '".$name."' '".$admin."' '".$maildir."' '".$quota_size."' '".$username."' '".$domain."' '".$database."'");
    echo $output;
    echo "<table style='background:lightgreen' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid green;color:green'>New user has been added successfully!</td></tr></table>";
   }

?>