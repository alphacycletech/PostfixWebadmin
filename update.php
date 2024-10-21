<?php
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

echo "<style>td {border:1px solid lightgrey;border-collapse:collapse;text-align:center;background:white;font-size:16px;} .input {border:0px;width:100%;background:grey;color:white;font-size:16px;text-align:center}.input:hover {background:black} .input2 {border:0px;width:100%;background:grey;color:white;font-size:16px;text-align:center}</style>";
echo "<form method='post'><table align='center' width='50%' style='margin-top:20vh'>";
echo "<tr><th>Current Version</th><th>Latest Version</th><th>Update Availablity</th></tr>";
echo "<tr><td>".($cur_version*1.0)."</td><td>".$latest_version."</td><td>"; if($cur_version!=$latest_version){echo "<input type='submit' name='update' value='Update' class='input'>";}else{echo "<input type='submit' name='update' value='Up-to-date' class='input2' disabled>";} echo "</td></tr>";
echo "</table></form>";

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
header('Location:update.php');
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
</style>";

echo "<div align='center'><iframe src='changelog.txt?".time()."'></iframe></div>";

?>