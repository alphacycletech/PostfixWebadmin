<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=0.5,maximum-scale=1,user-scalable=no'/>";
include('config.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";

echo "<style>.input {border:1px solid lightgrey;border-collapse:collapse;text-align:center;white-space:nowrap} tr.input:nth-child(even) {background: lightgrey;} tr.input:nth-child(odd) {background: white;} .icon-btn {color:black;font-size:150%}</style>";
echo "<table align='center' style='margin-top:10vh;table-layout:fixed'>";
echo "<tr><th width='70px'>Username</th><th width='200px'>Full Name</th><th width='70px'>Admin</th><th width='150px'>Usage / Quota</th><th width='150px'>Domain</th><th width='150px'>Created Date</th><th width='150px'>Modified Date</th><th width='70px'>Active</th><th width='10px'></th></tr>";

if(!isset($_GET['page'])){
    $page=1;
}else{
    $page=$_GET['page'];
}

$output=shell_exec("python3 list.py '".$domain."' '".$database."' '".$page."'");
$result=explode('|',$output);
$result_array=array_chunk($result, 9);
$i=count($result_array);
for($x=0;$x<$i-1;$x++){
    echo "<tr class='input'><td class='input'>".$result_array[$x][4]."</td><td class='input'>".$result_array[$x][1]."</td><td class='input'>";if($result_array[$x][2]==1){echo 'Yes';}else{echo 'No';} echo "</td><td class='input'>";$quota_check=shell_exec('sudo du -sh /www/vmail/'.$result_array[$x][5].'/'.$result_array[$x][4]); if(strpos($quota_check,'K')!=0){echo substr($quota_check,0,(strpos($quota_check,'K')))." KB";}elseif(strpos($quota_check,'M')!=0){echo substr($quota_check,0,(strpos($quota_check,'M')))." MB";}elseif(strpos($quota_check,'G')!=0){echo substr($quota_check,0,(strpos($quota_check,'G')))." GB";}else{echo '0 KB';} echo " / ".($result_array[$x][3]/1024/1024)." MB</td><td class='input'>".$result_array[$x][5]."</td><td class='input'>".$result_array[$x][6]."</td><td class='input'>".$result_array[$x][7]."</td><td class='input'>"; if($result_array[$x][8]==1){echo 'Yes';}else{echo 'No';} echo "</td><td class='blank' colspan=2><a href='maintenance.php?domain=".$result_array[$x][5]."&cur_username=".urlencode($result_array[$x][4])."&cur_quota=".$result_array[$x][3]."&cur_admin=".$result_array[$x][2]."&cur_active=".$result_array[$x][8]."&cur_name=".urlencode($result_array[$x][1])."' class='icon-btn'><i class='fa fa-edit'></i></a></td><td class='blank'><a href='delete.php?domain=".$result_array[$x][5]."&cur_username=".$result_array[$x][4]."' class='icon-btn'><i class='fa fa-trash'></i></a></tr>";}

echo "</table>";
$min_page=1;
$max_page=ceil(str_replace(')','',str_replace(',','',str_replace('(','',end($result))))/10);
echo "<p align='center'>Page ";
while($min_page<=$max_page){
    if($min_page==$page){
        echo "<b>".$min_page."</b>";
    }else{
        echo "<a href='?page=".$min_page."' style='text-decoration:none'> ".$min_page." </a>";
    }
    $min_page++;
}
echo "</p>";
echo "<p align='center' style='color:grey'>".$sub_title."</p>";
?>