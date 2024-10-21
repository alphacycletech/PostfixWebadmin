<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
$cur_username=urldecode($_GET['cur_username']);
$cur_name=urldecode($_GET['cur_name']);
$cur_admin=$_GET['cur_admin'];
$cur_active=$_GET['cur_active'];
$email=$cur_username.'@'.$domain;
$quota_type=1024*1024;
$cur_quota=$_GET['cur_quota']/$quota_type;

if(!isset($_POST['name'])){
    
}else{
    $name=$_POST['name'];
}

if(!isset($_POST['admin'])){
    
}else{
    $admin=$_POST['admin'];
}

if(!isset($_POST['active'])){
    
}else{
    $active=$_POST['active'];
}


if(!isset($_POST['password'])){
    $password='';
}else{
    $password=$_POST['password'];
}

$quota=$_POST['quota'];

if($_POST['quota']==''){
    $quota=0;
}else{
    $quota=$_POST['quota'];
}

$quota_size=$quota*$quota_type;

echo "<style>.input {height:40px;width:200px;border:1px solid lightgrey;font-size:16px;text-align:center} .input2 {height:40px;width:80px;border:1px solid lightgrey;font-size:16px;text-align:center} .submit {height:40px;background:grey;border:0px;width:100%;font-weight:bold;font-size:16px;color:white} .submit:hover {background:black} select {text-align-last:center}</style>";
echo "<form method='post'><table align='center' style='margin-top:20vh'>";
echo "<tr><th>Full Name</th><th>Username</th><th>Password</th><th>Admin</th><th colspan=2>Quota</th><th>Active</th></tr>";
echo "<tr><td ><input type='text' name='name' placeholder='Full Name' class='input' value='"; if(isset($name)){echo $name;}else{echo $cur_name;} echo "'></td><td><input type='text' name='username' placeholder='Username' class='input' disabled value='".$cur_username."'></td><td><input type='password' name='password' placeholder='Leave Blank To Remain' class='input'></td><td><select name='admin' class='input2'><option value=0 "; if(isset($admin) && $admin==0){echo 'selected';}elseif(!isset($admin) && $cur_admin==0){echo 'selected';} echo ">No</option><option value=1 "; if(isset($admin) && $admin==1){echo 'selected';}elseif(!isset($admin) && $cur_admin==1){echo 'selected';}  echo ">Yes</option></select></td><td><input type='number' min=1 name='quota' placeholder='Mailbox Size' class='input' value="; if($quota==0){echo $cur_quota;}else{echo $quota;} echo "></td><td>MB</td><td><select name='active' class='input2'><option value=1 "; if(isset($active) && $active==1){echo 'selected';}elseif(!isset($active) && $cur_active==1){echo 'selected';} echo ">Yes</option><option value=0 "; if(isset($active) && $active==0){echo 'selected';}elseif(!isset($active) && $cur_active==0){echo 'selected';}  echo ">No</option></select></td></tr></table>";
echo "<table align='center'><tr><td width='200px'><input type='submit' name='submit' value='UPDATE' class='submit'></td><td width='200px'><input type='submit' name='back' value='BACK' class='submit'></td></tr>";
echo "</table></form>";
echo "<p align='center' style='color:grey'>".$sub_title."</p>";

if(!isset($_POST['back'])){
    
}else{
    header('Location:list.php?domain='.$domain);
}

if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && ($_POST['name']=='' || $_POST['quota']=='')){
    echo "<table style='background:pink' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}else{
    $output=shell_exec("python3 maintenance.py '".$email."' '".$domain."' '".$password."' '".$quota_size."' '".$admin."' '".$active."' '".$name."' '".$database."'");
    echo $output;
    echo "<table style='background:lightgreen' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid green;color:green'>The records have been updated successfully!</td></tr></table>";
   }
?>