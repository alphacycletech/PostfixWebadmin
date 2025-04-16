<?php
include('config.php');
session_start();
include('logincheck.php');
echo "<meta name='viewport' content='width=device-width,initial-scale=0.5,maximum-scale=1,user-scalable=no'/>";
include('style.php');
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
shell_exec('sudo python3 trace.py');

$db = new SQLite3('maillog.db');

if(!isset($_GET['page'])){
    $page=1;
}else{
    $page=$_GET['page'];
}

$listcontent = $db->query("SELECT A.Date,A.Server,A.QueueId,A.EmailId,A.FromUser,B.ToUser,B.Status FROM (SELECT * FROM log WHERE Status='' ORDER BY Date DESC) A INNER JOIN (SELECT * FROM log WHERE Status<>'' ORDER BY Date DESC) B ON A.EmailId=B.EmailId WHERE A.FromUser NOT IN ('root@localhost.localdomain','') AND (A.FromUser LIKE '%".$domain."' OR B.ToUser LIKE '%".$domain."') ORDER BY A.Date DESC LIMIT 10 OFFSET ".(($page-1)*10));
$countcontent = $db->query("SELECT COUNT(*) AS 'Count' FROM (SELECT * FROM log WHERE Status='' ORDER BY Date DESC) A INNER JOIN (SELECT * FROM log WHERE Status<>'' ORDER BY Date DESC) B ON A.EmailId=B.EmailId WHERE A.FromUser NOT IN ('root@localhost.localdomain','') AND (A.FromUser LIKE '%".$domain."' OR B.ToUser LIKE '%".$domain."')");

while ($row = $countcontent->fetchArray()) {
    $totalcount=$row['Count'];
}

echo "<body style='background:rgba(0,0,0,0)'>";
echo "<style>td {white-space: nowrap;} .font-md {font-size:12px}</style>";
echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<table align='center' style='margin-top:10vh;text-align:center;width:100%' class='table table-striped font-md'>";
echo "<thead>";
echo "<tr><th class='col-lg-1'>Date</th>
<th class='col-lg-1'>Server</th>
<th class='col-lg-1'>Queue Id</th>
<th class='col-lg-1'>Email Id</th>
<th class='col-lg-2'>From</th>
<th class='col-lg-2'>To</th>
<th class='col-lg-1'>Status</th></tr>";
echo "</thead>";
echo "<tbody>";

while ($row = $listcontent->fetchArray()) {
    echo "<tr><td>".$row['Date']."</td>
    <td>".$row['Server']."</td>
    <td>".$row['QueueId']."</td>
    <td>".$row['EmailId']."</td>
    <td>".$row['FromUser']."</td>
    <td>".$row['ToUser']."</td>
    <td>".$row['Status']."</td></tr>";   
}

echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
$min_page=1;
$max_page=ceil($totalcount/10);
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