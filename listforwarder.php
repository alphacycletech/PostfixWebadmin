<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
include('config.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";

echo "<style>.input {border:1px solid lightgrey;border-collapse:collapse;text-align:center;white-space:nowrap} tr.input:nth-child(even) {background: lightgrey;} tr.input:nth-child(odd) {background: white;} .icon-btn {color:black;font-size:150%}</style>";
echo "<table align='center' style='margin-top:10vh'>";
echo "<tr><th width='70px'>Forwarder</th><th width='200px'>Recipient</th><th width='150px'>Domain</th><th width='150px'>Created Date</th><th width='150px'>Modified Date</th><th width='70px'>Active</th><th width='10px'></th></tr>";
       
if(!isset($_GET['page'])){
    $page=1;
}else{
    $page=$_GET['page'];
}
       
$output=shell_exec("python3 listforwarder.py '".$domain."' '".$database."' '".$page."'");
$result=explode('|',$output);
$result_array=array_chunk($result, 6);
$i=count($result_array);
for($x=0;$x<$i-1;$x++){
    echo "<tr class='input'><td class='input'>".$result_array[$x][0]."</td><td class='input'>".$result_array[$x][1]."</td><td class='input'>".$result_array[$x][2]."</td><td class='input'>".$result_array[$x][3]."</td><td class='input'>".$result_array[$x][4]."</td><td class='input'>"; if($result_array[$x][5]==1){echo 'Yes';}else{echo 'No';} echo "</td><td class='blank' colspan=2><a href='maintenanceforwarder.php?domain=".$result_array[$x][2]."&cur_email=".$result_array[$x][0]."&cur_recipient=".$result_array[$x][1]."&cur_active=".$result_array[$x][5]."' class='icon-btn'><i class='fa fa-edit'></i></a></td><td class='blank'><a href='deleteforwarder.php?domain=".$result_array[$x][2]."&cur_email=".$result_array[$x][0]."' class='icon-btn'><i class='fa fa-trash'></i></a></tr>";
}

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