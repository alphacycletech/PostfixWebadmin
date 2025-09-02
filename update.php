<?php
include('style.php');
session_start();
include('logincheck.php');
echo "<body style='background:rgba(0,0,0,0)'>";
shell_exec('rm -f update.txt');
shell_exec('wget --content-disposition https://www.alphacycletech.com/webadmin/update/update.txt update.txt --no-check-certificate');
$cur_version=file_get_contents('version.txt');


if(file_get_contents('update.txt')-$cur_version!=0.1 && file_get_contents('update.txt')!=$cur_version){
    $latest_version=$cur_version+0.1;
    shell_exec('rm -f changelog.txt');
    shell_exec('wget --content-disposition https://www.alphacycletech.com/webadmin/update/changelog.txt changelog.txt --no-check-certificate');
}else{
    $latest_version=file_get_contents('update.txt');
    shell_exec('rm -f changelog.txt');
    shell_exec('wget --content-disposition https://www.alphacycletech.com/webadmin/update/changelog.txt changelog.txt --no-check-certificate');
}

echo "<style>.font-md {font-size:12px}</style>";
echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<form method='post'><table style='margin-top:10vh;margin-left:25%;width:50%' class='table font-md text-center'>";
echo "<thead>";
echo "<tr><th class='col-lg-1'>Current Version</th>
<th class='col-lg-1'>Latest Version</th>
<th class='col-lg-1'>Update Availablity</th></tr>";
echo "</thead>";
echo "<tbody class='align-top'>";
echo "<tr><td><p class='form-control font-md'>".number_format($cur_version*1.0,1,'.','')."</p></td>
<td><p class='form-control font-md'>".number_format($latest_version,1,'.','')."</p></td>
<td>"; if($cur_version!=$latest_version){echo "<input type='submit' name='update' value='Update' class='btn btn-secondary font-md' style='width:100%'>";}else{echo "<input type='submit' name='update' value='Up-to-date' class='btn btn-secondary font-md' disabled style='width:100%'>";} echo "</td></tr>";
echo "</tbody>";
echo "</table></form>";
echo "</div>";
echo "</div>";

if(isset($_POST['update'])){
shell_exec('wget --content-disposition https://www.alphacycletech.com/webadmin/update/'.$latest_version.'.zip '.$latest_version.'.zip --no-check-certificate');
shell_exec('mkdir temp');
shell_exec('mv -f '.$latest_version.'.zip temp/'.$latest_version.'.zip');
shell_exec('unzip temp/'.$latest_version.'.zip -d temp');
shell_exec('rm -f temp/'.$latest_version.'.zip');
shell_exec('mv -f temp/* .');
shell_exec('rm -rf temp');
shell_exec('rm -f update.txt');
shell_exec('rm -f changelog.txt');
file_put_contents('version.txt',$latest_version);
echo "<script>parent.location.href='index.php';</script>";
}

/*$content = file_get_contents('changelog.txt');
$lines = explode("\n", $content);
$skipped_content = implode("\n", array_slice($lines, -13));
echo "<table align='center'><tr><td style='text-align:justify'><pre>".$skipped_content."</pre></td></tr></table>";*/

echo "<style>
iframe {
  border:1px solid lightgrey;
  width:50%;
  height:50%;
  background:white; 
}

@media (max-width: 600px) {
iframe {
  border:1px solid lightgrey;
  width:70%;
  height:50%;
  background:white;
}
}

}
}
</style>";

echo "<div align='center'><iframe src='changelog.txt?".time()."'></iframe></div>";

?>
