<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
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

echo "<style>.input {height:40px;width:200px;border:1px solid lightgrey;font-size:16px;text-align:center} .input2 {height:40px;width:80px;border:1px solid lightgrey;font-size:16px;text-align:center} .submit {height:40px;background:grey;border:0px;width:100%;font-weight:bold;font-size:16px;color:white} .submit:hover {background:black} select {text-align-last:center}</style>";
echo "<form method='post'><table align='center' style='margin-top:20vh'>";
echo "<tr><th>Forwarder</th><th>Recipient</th><th>Active</th></tr>";
echo "<tr><td ><input type='text' class='input' value=".$forwarder." disabled></td><td><input type='text' name='recipient' placeholder='Receipient Email' class='input' value="; if(isset($recipient)){echo $recipient;}else{echo $cur_recipient;} echo "></td><td><select name='active' class='input2'><option value=1 "; if(isset($active) && $active==1){echo 'selected';}elseif(!isset($active) && $cur_active==1){echo 'selected';} echo ">Yes</option><option value=0 "; if(isset($active) && $active==0){echo 'selected';}elseif(!isset($active) && $cur_active==0){echo 'selected';}  echo ">No</option></select></td></tr></table>";
echo "<table align='center'><tr><td width='200px'><input type='submit' name='submit' value='UPDATE' class='submit'></td><td width='200px'><input type='submit' name='back' value='BACK' class='submit'></td><td></td><td></td><td></td></tr>";
echo "</table></form>";
echo "<p align='center' style='color:grey'>Multiple recipients please separate with comma (,)</p>";
echo "<p align='center' style='color:grey'>".$sub_title."</p>";

if(!isset($_POST['back'])){
    
}else{
    header('Location:listforwarder.php?domain='.$domain);
}

if(!isset($_POST['submit'])){
    
}elseif(isset($_POST['submit']) && $_POST['recipient']==''){
    echo "<table style='background:pink' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}else{
    $output=shell_exec("python3 maintenanceforwarder.py '".$forwarder."' '".$recipient."' '".$domain."' '".$active."' '".$database."'");
    echo $output;
    
    echo "<table style='background:lightgreen' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid green;color:green'>The records have been updated successfully!</td></tr></table>";
   }

?>