<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
include('style.php');
session_start();
include('logincheck.php');

$forwarder=$_GET['cur_email'];
$cur_recipient=$_GET['cur_recipient'];
$cur_active=$_GET['cur_active'];

if(!isset($_POST['recipient'])){
    
}else{
    $recipient=$_POST['recipient'];
}

if(!isset($_POST['active'])){
    
}else{
    $active=$_POST['active'];
}

echo "<style>td {white-space: nowrap;} .font-md {font-size:12px}</style>";
echo "<body style='background:rgba(0,0,0,0)'>";
echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<form method='post'>";
echo "<table align='center' style='margin-top:20vh;text-align:center;width:100%' class='table font-md'>";
echo "<thead>";
echo "<tr><th class='col-lg-2'>Forwarder</th><th class='col-lg-2'>Recipient</th><th class='col-lg-1'>Active</th></tr>";
echo "</thead>";
echo "<tbody>";
echo "<tr><td><input type='text' class='form-control font-md text-center' value=".$forwarder." disabled></td><td><input type='text' name='recipient' placeholder='Receipient Email' class='form-control font-md text-center' id='recipient' value="; if(isset($recipient)){echo $recipient;}else{echo $cur_recipient;} echo "></td><td><select name='active' class='form-control font-md text-center'><option value=1 "; if(isset($active) && $active==1){echo 'selected';}elseif(!isset($active) && $cur_active==1){echo 'selected';} echo ">Yes</option><option value=0 "; if(isset($active) && $active==0){echo 'selected';}elseif(!isset($active) && $cur_active==0){echo 'selected';}  echo ">No</option></select></td></tr></tbody></table>";
echo "<table class='text-center'><tr><td class='col-lg-1'><input type='submit' name='submit' value='UPDATE' class='btn btn-secondary font-md' style='width:12.5%'>&nbsp<input type='submit' name='back' value='BACK' class='btn btn-secondary font-md' style='width:12.5%'></td></tr>";
echo "</table></form>";
echo "</div>";
echo "</div>";
echo "<p align='center' style='color:grey' class='font-md'>Multiple recipients please separate with comma (,)</p>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";

if(!isset($_POST['back'])){
    
}else{
    header('Location:listforwarder.php?domain='.$domain);
}

if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && $_POST['recipient']==''){
    echo "<table style='background:pink' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}else{
    $output=shell_exec("python3 maintenanceforwarder.py '".$forwarder."' '".$recipient."' '".$domain."' '".$active."' '".$database."'");
    echo $output;
    
    echo "<table style='background:lightgreen' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid green;color:green'>The records have been updated successfully!</td></tr></table>";
   }

?>
<html>
<script>
window.onload = function() {
  document.getElementById("recipient").focus();
}
</script>
</html>