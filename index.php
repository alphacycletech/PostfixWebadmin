<?php
include('config.php');
include('style.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";

session_start();
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
echo "<title>".$title."</title>";
echo "<link href='".$favicon."' rel='icon' type='image/x-icon' />";
echo "<body style='background:url(".$background.");background-attachment:fixed;background-size:cover'>";

$token=md5(date('Y-m-d H:i:s'));

if(!isset($_POST['username'])){

}else{
    $username=$_POST['username'];
}

if(!isset($_POST['password'])){
    
}else{
    $password=$_POST['password'];
}

echo "<div align='center' style='margin-top:20vh'><img src='".$logo."' width='170vw'></div>";
echo "<style>.font-md {font-size:12px} .font-lg {font-size:30px} #checking_btn:hover {color:#6B6666 !important}</style>";
echo "<form method='post'><table align='center' style='margin-top:2vh'>";
echo "<tr><td align='center'><i class='fa fa-user font-lg'></i>&nbsp</td><td><input type='text' name='username' placeholder='Username' class='form-control font-md text-center' autofocus></td></tr>";
echo "<tr><td align='center'><i class='fa fa-lock font-lg'></i>&nbsp</td><td><input type='password' name='password' placeholder='Password' class='form-control font-md text-center'></td></tr>";
echo "<tr><td colspan=2><input type='submit' name='submit' value='LOGIN' class='btn btn-secondary font-md' style='width:100%'></td></tr>";
echo "</table></form>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";
echo "<a href='checking.php' title='Check Dependencies' style='text-decoration:none;color:grey;font-size:2vw;position:absolute;bottom:1%;right:1%;z-index:10' id='checking_btn'><i class='fa fa-exclamation-circle'></i></a>";
   
if(!isset($_POST['submit'])){
}else{
    $output=shell_exec("python3 login.py '".$username."' '".$username."' '".$password."' '".$domain."' '".$database."'");
    $result=explode('|',$output);
    if(strpos(strval($output),'|')!=''){
        $_SESSION['login']=$token;
        $_SESSION['name']=$result[1];
        $_SESSION['user']=$result[0];
        header('Location:home.php');
    }
echo "<table style='background:pink' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid red;color:red'>You've entered the wrong username or password!</td></tr></table>";
      }
echo "<style>.footer {  position: fixed;right: 0;bottom: -3%;left: 0;padding: 1rem; style='background:rgba(0,0,0,0)';text-align: center;}</style>";
echo "</body></table>";
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
