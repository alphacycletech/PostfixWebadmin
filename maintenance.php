<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
include('style.php');
session_start();
include('logincheck.php');

$cur_username=urldecode($_GET['cur_username']);

$output=shell_exec("python3 getuserinfo.py '".$domain."' '".$database."' '".$cur_username."'");
$result=explode('|',$output);

$cur_name=$result[0];
$cur_admin=$result[1];
$cur_active=$result[3];
$email=$cur_username.'@'.$domain;
$quota_type=1024*1024;
$cur_quota=$result[2]/$quota_type;

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

echo "<style>td {white-space: nowrap;} .btn {white-space: nowrap} .font-md {font-size:12px}</style>";
echo "<body style='background:rgba(0,0,0,0)'>";
echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<form method='post'>";
echo "<table align='center' style='margin-top:20vh;text-align:center;width:100%' class='table font-md'>";
echo "<thead>";
echo "<tr><th class='col-lg-2'>Full Name</th>
<th class='col-lg-2'>Username</th>
<th class='col-lg-2'>Password</th>
<th class='col-lg-1'>Admin</th>
<th  class='col-lg-1' colspan=2>Quota</th>
<th class='col-lg-1'>Active</th></tr>";
echo "</thead>";
echo "<tbody class='align-middle'>";
echo "<tr><td ><input type='text' name='name' placeholder='Full Name' class='form-control font-md text-center' id='name' value='"; if(isset($name)){echo $name;}else{echo $cur_name;} echo "'></td>
<td><input type='text' name='username' placeholder='Username' disabled class='form-control font-md text-center' value='".$cur_username."'></td>
<td><input type='password' name='password' placeholder='Leave Blank To Remain' class='form-control font-md text-center'></td>
<td><select name='admin' class='form-control font-md text-center'><option value=0 "; if(isset($admin) && $admin==0){echo 'selected';}elseif(!isset($admin) && $cur_admin==0){echo 'selected';} echo ">No</option><option value=1 "; if(isset($admin) && $admin==1){echo 'selected';}elseif(!isset($admin) && $cur_admin==1){echo 'selected';}  echo ">Yes</option></select></td>
<td><input type='number' min=1 name='quota' placeholder='Mailbox Size' class='form-control font-md text-center' value="; if($quota==0){echo $cur_quota;}else{echo $quota;} echo "></td>
<td>MB</td>
<td><select name='active' class='form-control font-md text-center'><option value=1 "; if(isset($active) && $active==1){echo 'selected';}elseif(!isset($active) && $cur_active==1){echo 'selected';} echo ">Yes</option><option value=0 "; if(isset($active) && $active==0){echo 'selected';}elseif(!isset($active) && $cur_active==0){echo 'selected';}  echo ">No</option></select></td></tr></tbody></table>";
echo "<table class='text-center'><tr><td class='col-lg-1'><input type='submit' name='submit' value='UPDATE' class='btn btn-secondary font-md' style='width:12.5%'>&nbsp<input type='submit' name='back' value='BACK' class='btn btn-secondary font-md' style='width:12.5%'></td></tr>";
echo "</table></form>";
echo "</div>";
echo "</div>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";

if(!isset($_POST['back'])){
    
}else{
    header('Location:list.php?domain='.$domain);
}

if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && ($_POST['name']=='' || $_POST['quota']=='')){
    echo "<table style='background:pink' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}else{
    $output=shell_exec("python3 maintenance.py '".$email."' '".$domain."' '".$password."' '".$quota_size."' '".$admin."' '".$active."' '".$name."' '".$database."'");
    echo $output;
    echo "<table style='background:lightgreen' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid green;color:green'>The records have been updated successfully!</td></tr></table>";
   }
?>
<html>
<script>
window.onload = function() {
  document.getElementById("name").focus();
}
</script>
</html>