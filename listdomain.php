<?php
echo "<meta name='viewport' content='width=device-width,initial-scale=0.5,maximum-scale=1,user-scalable=no'/>";
include('config.php');
include('style.php');
session_start();
include('logincheck.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";

echo "<style>td {white-space: nowrap;} .font-md {font-size:12px}</style>";
echo "<body style='background:rgba(0,0,0,0)'>";
echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<table align='center' style='margin-top:10vh;text-align:center;width:100%' class='table table-striped font-md'>";
echo "<thead>";
echo "<tr><th class='col-lg-1'>Domain</th>
<th class='col-lg-2'>A Record</th>
<th class='col-lg-1'>Active</th>
<th class='col-lg-1'>Mailboxes</th>
<th class='col-lg-1'>Quota</th>
<th class='col-lg-1'>Rate Limit</th>
<th class='col-lg-1'>SSL Alarm</th>
<th class='col-lg-1'>Current Usage</th>
<th class='col-lg-1'>Created Date</th>
<th class='col-lg-1'></th></tr>";
echo "</thead>";

if(!isset($_GET['page'])){
    $page=1;
}else{
    $page=$_GET['page'];
}

$output=shell_exec("python3 listdomain.py '".$domain."' '".$database."' '".$page."'");
$result=explode('|',$output);
$result_array=array_chunk($result, 9);
$i=count($result_array);
echo "<tbody>";
for($x=0;$x<$i-1;$x++){
    echo "<tr><td>".$result_array[$x][0]."</td>
    <td>".$result_array[$x][1]."</td>
    <td>";if($result_array[$x][2]==1){echo 'Yes';}else{echo 'No';} echo "</td>
    <td>".$result_array[$x][3]."</td>
    <td>"; if(($result_array[$x][4]/1024/1024/1024)<1){echo round(($result_array[$x][4]/1024/1024),0)." MB";}else{echo round(($result_array[$x][4]/1024/1024/1024),0)." GB";} echo"</td>
    <td>".$result_array[$x][5]."</td>
    <td>"; if($result_array[$x][6]==1){echo 'Yes';}else{echo 'No';} echo "</td>
    <td>"; if(($result_array[$x][7]/1024/1024/1024)<1){echo round(($result_array[$x][7]/1024/1024),0)." MB";}else{echo round(($result_array[$x][7]/1024/1024/1024),0)." GB";} echo"</td>
    <td>".$result_array[$x][8]."</td>
    <td><a href='maintenancedomain.php?cur_domain=".$result_array[$x][0]."' class='btn btn-primary' style='padding:2px'><i class='fa fa-edit'></i></a></td></tr>";}

echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
$min_page=1;
$max_page=ceil(str_replace(')','',str_replace(',','',str_replace('(','',end($result))))/10);
echo "<p align='center' class='font-md'><a href='?page=1' title='First Page' style='text-decoration:none;padding:5px;"; if($page==1){echo "font-weight:bold;color:silver;pointer-events:none";} echo "'><<</a><a href='?page=".($page-1)."' title='Previous Page' style='text-decoration:none;padding:5px;"; if($page==1){echo "font-weight:bold;color:silver;pointer-events:none";} echo "'><</a>";
while($min_page<=$max_page){
    if($min_page==$page){
        echo "<b class='font-md' style='padding:5px'>".$min_page."</b>";
    }else{
        echo "<a href='?page=".$min_page."' title='".$min_page."' style='text-decoration:none;padding:5px;"; if(($page==1 || $page==2 || $page==3) && $min_page>5){echo "display:none";}elseif(($page==$max_page || $page==$max_page-1 || $page==$max_page-2) && $min_page<$max_page-4){echo "display:none";}elseif($page>=4 && $min_page-$page>2){echo "display:none";}elseif($max_page-$page>=3 && $page-$min_page>2){echo "display:none";} echo "'> ".$min_page." </a>";
    }
    $min_page++;
}
echo "<a href='?page=".($page+1)."' title='Next Page' style='text-decoration:none;padding:5px;"; if($page==$max_page || $max_page==0){echo "font-weight:bold;color:silver;pointer-events:none";} echo "'>></a><a href='?page=".$max_page."' title='Last Page' style='text-decoration:none;padding:5px;"; if($page==$max_page || $max_page==0){echo "font-weight:bold;color:silver;pointer-events:none";} echo "'>>></a></p>";
echo "<p align='center' style='color:grey' class='font-md'>".$sub_title."</p>";
?>