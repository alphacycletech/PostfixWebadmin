<?php
include('config.php');
include('style.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";

session_start();
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
echo "<title>".$title."</title>";
echo "<link href='".$favicon."' rel='icon' type='image/x-icon' />";
echo "<body style='background:url(".$background.");background-attachment:fixed;background-size:cover'>";

$valid="<i class='fa fa-check' style='color:green'></i>";
$invalid="<i class='fa fa-times' style='color:red'></i>";

echo "<h3 style='text-align:center;margin-top:10%'>Check Dependencies</h3>";
echo "<table class='table table-bordered table-striped font-md' style='width:20%;position:absolute;left:40%;top:30%'>";
echo "<thead class='bg-dark text-white'>";
echo "<tr>";
echo "<th class='col-lg-2'>Description</th>";
echo "<th class='col-lg-1' colspan=2>Result</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
echo "<tr>";
echo "<td>Shell Exec</td>";
echo "<td>";

if (function_exists('shell_exec') && false === stripos(ini_get('disable_functions'), 'shell_exec')) {
        echo $valid;
} else {
        echo $invalid;
}
    
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Python 3</td>";
echo "<td>";

$python3_path = shell_exec('which python3');

if (!empty($python3_path)) {
    echo $valid;
} else {
    echo $invalid;
}

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Python 3 Pandas</td>";
echo "<td>";

$pandas_path = shell_exec('pip show pandas');

if (!empty($pandas_path)) {
    echo $valid;
} else {
    echo $invalid;
}

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Python 3 Numpy</td>";
echo "<td>";

$numpy_path = shell_exec('pip show numpy');

if (!empty($numpy_path)) {
    echo $valid;
} else {
    echo $invalid;
}

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Config.ini</td>";
echo "<td>";

$currentDirectory = getcwd();

if(strlen(shell_exec("ls ".$currentDirectory."/config.ini"))>2){
    echo $valid;
}else{
    echo $invalid;
}

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Config.php</td>";
echo "<td>";

$currentDirectory = getcwd();

if(strlen(shell_exec("ls ".$currentDirectory."/config.php"))>2){
    echo $valid;
}else{
    echo $invalid;
}

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Domain</td>";
echo "<td>";

if(strlen($domain)>2){
    echo $valid;
}else{
    echo $invalid;
}

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Database</td>";
echo "<td>";

if(strlen(shell_exec("ls ".$database))>2){
    echo $valid;
}else{
    echo $invalid;
}

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=2><a href='checking.php' class='btn btn-secondary font-md' style='width:49%'>Re-Check</a>";
echo "&nbsp<a href='index.php' class='btn btn-secondary font-md' style='width:49%'>Back</a></td>";
echo "</tr>";

echo "</tbody>";
echo "</table>";
echo shell_exec("pip show pandass");
echo "<style>.font-md {font-size:12px} .font-lg {font-size:30px}</style>";
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
