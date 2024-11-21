<?php
include('config.php');
include('style.php');
session_start();
include('logincheck.php');
$name=$_SESSION['name'];
$user=$_SESSION['user'];
$token=$_GET['token'];
$update=$_GET['update'];
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
echo "<title>".$title."</title>";
echo "<link href='".$favicon."' rel='icon' type='image/x-icon' />";
echo "<body style='background:url(".$background.");background-attachment:fixed;background-size:cover'>";

if(!isset($_GET['module'])){
    $module='list';
}else{
    $module=$_GET['module'];
}

echo "<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

.font-md {font-size:12px}
.font-lg {font-size:14px}
#font-grey {color:grey}
</style>";

echo "<nav class='navbar navbar-expand-lg navbar-light bg-dark text-light' style='position:sticky;top:0px;z-index:1000'>";
echo "<div class='container'>";
echo "<a class='navbar-brand' href='?module=setting&token=$token' style='color:white'><img src='".$logo2."' style='width:50px;"; if($module=='setting'){echo "-webkit-filter:drop-shadow(1px 1px) drop-shadow(-1px -1px) drop-shadow(1px -1px) drop-shadow(-1px 1px);filter:drop-shadow(1px 1px) drop-shadow(-1px -1px) drop-shadow(1px -1px) drop-shadow(-1px 1px)";} echo "';/></a>";
echo "<button class='navbar-toggler' style='background:white' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>";
echo "<span class='navbar-toggler-icon'></span>";
echo "</button>";
echo "<div class='collapse navbar-collapse' id='navbarNav'>";
echo "<ul class='navbar-nav font-lg'>";
echo "
  <li class='nav-item'><a href='?module=modify&token=$token' id='font-grey' class='nav-link' "; if($module=='modify'){echo "style='color:white'";} echo ">Change Password</a></li>
  <li class='nav-item'><a href='?module=list&token=$token' id='font-grey' class='nav-link' "; if($module=='list'){echo "style='color:white'";} echo ">List Users</a></li>
  <li class='nav-item'><a href='?module=adduser&token=$token' id='font-grey' class='nav-link' "; if($module=='adduser'){echo "style='color:white'";} echo ">Add Users</a></li>
  <li class='nav-item'><a href='?module=listforwarder&token=$token' id='font-grey' class='nav-link' "; if($module=='listforwarder'){echo "style='color:white'";} echo ">List Forwarders</a></li>
  <li class='nav-item'><a href='?module=addforwarder&token=$token' id='font-grey' class='nav-link' "; if($module=='addforwarder'){echo "style='color:white'";} echo ">Add Forwarders</a></li>
  <li class='nav-item'><a href='?module=trace&token=$token' id='font-grey' class='nav-link' "; if($module=='trace'){echo "style='color:white'";} echo ">Trace</a></li>
  <li class='nav-item'><a href='?module=update&token=$token' id='font-grey' class='nav-link' "; if($module=='update'){echo "style='color:white'";} echo ">Check For Update</a></li>
  <li class='nav-item'><a href='logout.php' id='font-grey' class='nav-link'>Logout</a></li>";
echo "</ul></div><p class='font-lg'>Welcome, ".$name."</p></div></nav>";

echo "<iframe src='".$module.".php?token=$token' style='display:block;border:0px;width:100%;height:83%;align:center'></iframe>";

echo "<style>.footer {  position: fixed;right: 0;bottom: -3%;left: 0;padding: 1rem;background:rgba(0,0,0,0);text-align: center;} .update {  position: fixed;right: 0;bottom: -3%;left: 0;padding: 1rem;background:rgba(0,0,0,0);text-align: right;}</style>";

echo "<footer><p class='footer font-md'>".$footer."</p></footer>";

function isMobileDevice() { 
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo 
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i" 
, $_SERVER["HTTP_USER_AGENT"]); 
} 
if(isMobileDevice()){ 
    echo "<div style='position:absolute;left:0px;top:0px;width:100%;height:100%;background:black;color:white;display:flex;justify-content:center;align-items:center;font-size:3vh;text-align:center'>Only desktop mode is supported. Please visit it with computer browser or enable desktop mode in your mobile.</div>"; 
} 
else { 
    
} 

?>