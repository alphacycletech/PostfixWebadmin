<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
include('style.php');
session_start();
include('logincheck.php');

$cur_domain=urldecode($_GET['cur_domain']);

$output=shell_exec("python3 getdomaininfo.py '".$domain."' '".$database."'");
$result=explode('|',$output);

$cur_arecord=$result[1];
$cur_mailboxes=$result[2];
$quota_type=1024*1024;
$cur_quota=$result[3]/$quota_type;

$mailboxes=$_POST['mailboxes'];

if($_POST['mailboxes']==''){
    $mailboxes=0;
}else{
    $mailboxes=$_POST['mailboxes'];
}

$quota=$_POST['quota'];

if($_POST['quota']==''){
    $quota=0;
}else{
    $quota=$_POST['quota'];
}

echo "<style>td {white-space: nowrap;} .btn {white-space: nowrap} .font-md {font-size:12px}</style>";
echo "<body style='background:rgba(0,0,0,0)'>";
echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<form method='post'>";
echo "<table align='center' style='margin-top:20vh;text-align:center;width:100%' class='table font-md'>";
echo "<thead>";
echo "<tr><th class='col-lg-2'>Domain</th>
<th class='col-lg-2'>A Record</th>
<th class='col-lg-2'>Mailboxes</th>
<th  class='col-lg-2' colspan=2>Quota</th></tr>";
echo "</thead>";
echo "<tbody class='align-middle'>";
echo "<tr><td ><input type='text' name='domain' placeholder='Domain' disabled class='form-control font-md text-center' id='domain' value='".$cur_domain."'></td>
<td><input type='text' name='arecord' placeholder='A record' disabled class='form-control font-md text-center' value='".$cur_arecord."'></td>
<td><input type='number' min=1 name='mailboxes' placeholder='Mailboxes' class='form-control font-md text-center' value="; if($mailboxes==0){echo $cur_mailboxes;}else{echo $mailboxes;} echo "></td>
<td><input type='number' min=1 name='quota' placeholder='Quota' class='form-control font-md text-center' value="; if($quota==0){echo $cur_quota;}else{echo $quota;} echo "></td>
<td>MB</td></tr></tbody></table>";
echo "<table class='text-center'><tr><td class='col-lg-1'><input type='submit' name='submit' value='UPDATE' class='btn btn-secondary font-md' style='width:12.5%'>&nbsp<input type='submit' name='back' value='BACK' class='btn btn-secondary font-md' style='width:12.5%'></td></tr>";
echo "</table></form>";
echo "</div>";
echo "</div>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";

if(!isset($_POST['back'])){
    
}else{
    header('Location:listdomain.php');
}

if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && ($_POST['mailboxes']=='' || $_POST['quota']=='')){
    echo "<table style='background:pink' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}else{
    $output=shell_exec("python3 maintenancedomain.py '".$domain."' '".$mailboxes."' '".$quota."' '".$database."'");
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