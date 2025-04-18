<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
include('style.php');
session_start();
include('logincheck.php');
echo "<style>td {white-space: nowrap;} .font-md {font-size:12px}</style>";
echo "<body style='background:rgba(0,0,0,0)'>";

if(!isset($_POST['forwarder'])){
    
}else{
    $forwarder=$_POST['forwarder'];
}

if(!isset($_POST['recipient'])){
    
}else{
    $recipient=$_POST['recipient'];
}

if(!isset($_POST['active'])){
    
}else{
    $active=$_POST['active'];
}

echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<form method='post'>";
echo "<table align='center' style='margin-top:20vh;text-align:center;width:100%' class='table font-md'>";
echo "<thead>";
echo "<tr><th class='col-lg-2'>Forwarder</th><th class='col-lg-2'>Recipient</th>
<th class='col-lg-2'>Domain</th><th class='col-lg-1'>Active</th></tr>";
echo "<tr><td ><input type='text' name='forwarder' placeholder='Forwarder Email' class='form-control font-md text-center' autofocus></td>
<td><input type='text' name='recipient' placeholder='Recipient Email' class='form-control font-md text-center'></td>
<td><input type='text' value='".$domain."' disabled class='form-control font-md text-center'></td>
<td><select name='active' class='form-control font-md text-center'><option value=1>Yes</option><option value=0>No</option></select></td></tbody></tr></table>";
echo "<table align='center' width='200px'><tr><td><input type='submit' name='submit' value='ADD' class='btn btn-secondary font-md' style='width:100%'></td></tr>";
echo "</table></form>";
echo "</div>";
echo "</div>";
echo "<p align='center' style='color:grey' class='font-md'>Multiple recipients please separate with comma (,)</p>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";
   
if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && ($_POST['forwarder']=='' || $_POST['recipient']=='')){
    echo "<table style='background:pink' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}else{
    $output=shell_exec("python3 addforwarder.py '".$forwarder."' '".$recipient."' '".$domain."' '".$database."'");
    echo $output;
    echo "<table style='background:lightgreen' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid green;color:green'>New forwarder has been added successfully!</td></tr></table>";
   }

?>