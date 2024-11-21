<?php
include('style.php');
session_start();
include('logincheck.php');
$config = parse_ini_file('config.ini', true);
$newdomain=$_POST['newdomain'];
$newtitle=$_POST['newtitle'];
$newfooter=$_POST['newfooter'];
$newbackground=$_POST['newbackground'];
$newlogo=$_POST['newlogo'];
$newlogo2=$_POST['newlogo2'];
$newfavicon=$_POST['newfavicon'];

if (!function_exists('write_ini_file')) {
    /**
     * Write an ini configuration file
     * 
     * @param string $file
     * @param array  $array
     * @return bool
     */
    function write_ini_file($file, $array = []) {
        // check first argument is string
        if (!is_string($file)) {
            throw new \InvalidArgumentException('Function argument 1 must be a string.');
        }

        // check second argument is array
        if (!is_array($array)) {
            throw new \InvalidArgumentException('Function argument 2 must be an array.');
        }

        // process array
        $data = array();
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $data[] = "[$key]";
                foreach ($val as $skey => $sval) {
                    if (is_array($sval)) {
                        foreach ($sval as $_skey => $_sval) {
                            if (is_numeric($_skey)) {
                                $data[] = $skey.'[] = '.(is_numeric($_sval) ? $_sval : (ctype_upper($_sval) ? $_sval : '"'.$_sval.'"'));
                            } else {
                                $data[] = $skey.'['.$_skey.'] = '.(is_numeric($_sval) ? $_sval : (ctype_upper($_sval) ? $_sval : '"'.$_sval.'"'));
                            }
                        }
                    } else {
                        $data[] = $skey.' = '.(is_numeric($sval) ? $sval : (ctype_upper($sval) ? $sval : '"'.$sval.'"'));
                    }
                }
            } else {
                $data[] = $key.' = '.(is_numeric($val) ? $val : (ctype_upper($val) ? $val : '"'.$val.'"'));
            }
            // empty line
            $data[] = null;
        }

        // open file pointer, init flock options
        $fp = fopen($file, 'w');
        $retries = 0;
        $max_retries = 100;

        if (!$fp) {
            return false;
        }

        // loop until get lock, or reach max retries
        do {
            if ($retries > 0) {
                usleep(rand(1, 5000));
            }
            $retries += 1;
        } while (!flock($fp, LOCK_EX) && $retries <= $max_retries);

        // couldn't get the lock
        if ($retries == $max_retries) {
            return false;
        }

        // got lock, write data
        fwrite($fp, implode(PHP_EOL, $data).PHP_EOL);

        // release lock
        flock($fp, LOCK_UN);
        fclose($fp);

        return true;
    }
}

echo "<style>td {white-space: nowrap;} .font-md {font-size:12px}</style>";
echo "<body style='background:rgba(0,0,0,0)'>";
echo "<form method='post'>";
echo "<div class='container'>";
echo "<div class='form-group row'>";
echo "<table align='center' style='margin-top:10vh;text-align:center;width:50%' class='font-md'>";
echo "<tr><th class='col-lg-1'>Domain*</th><td class='col-lg-3'><input type='textbox' name='newdomain' class='form-control font-md' id='domain' value='".$config['system']['domain']."'/></td></tr>";
echo "<tr><th class='col-lg-1'>Title*</th><td class='col-lg-3'><input type='textbox' class='form-control font-md' name='newtitle' value='".$config['system']['title']."'/></td></tr>";
echo "<tr><th class='col-lg-1'>Footer*</th><td class='col-lg-3'><input type='textbox' class='form-control font-md' name='newfooter' value='".$config['system']['footer']."'/></td></tr>";
echo "<tr><th class='col-lg-1'>Background</th><td class='col-lg-3'><input type='textbox' class='form-control font-md' name='newbackground' value='".$config['system']['background']."'/></td></tr>";
echo "<tr><th class='col-lg-1'>Logo</th><td class='col-lg-3'><input type='textbox' class='form-control font-md' name='newlogo' value='".$config['system']['logo']."'/></td></tr>";
echo "<tr><th class='col-lg-1'>Logo 2</th><td class='col-lg-3'><input type='textbox' class='form-control font-md' name='newlogo2' value='".$config['system']['logo2']."'/></td></tr>";
echo "<tr><th class='col-lg-1'>Favicon</th><td class='col-lg-3'><input type='textbox' class='form-control font-md' name='newfavicon' value='".$config['system']['favicon']."'/></td></tr>";
echo "<tr><td style='text-align:right' colspan=2><button type='submit' class='btn btn-secondary font-md' name='submit'>Update</button></td></tr>";
echo "</table>";
echo "</form>";
echo "</div>";
echo "</div>";

if(isset($_POST['submit']) && $newdomain!='' && $newtitle!='' && $newfooter!=''){
    echo "<table style='background:lightgreen' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid green;color:green'>Setting has been updated successfully!</td></tr></table>";
    $config['system']['domain'] = $newdomain;
    $config['system']['title'] = $newtitle;
    $config['system']['footer'] = $newfooter;
    $config['system']['background'] = $newbackground;
    $config['system']['logo'] = $newlogo;
    $config['system']['logo2'] = $newlogo2;
    $config['system']['favicon'] = $newfavicon;
    write_ini_file('config.ini', $config);
    echo "<script>parent.document.location.href='logout.php'</script>";
}elseif(isset($_POST['submit']) && ($newdomain=='' || $newtitle=='' || $newfooter=='')){
    echo "<table style='background:pink' align='center' class='font-md'><tr height='40px'><td width='300px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}
?>
<html>
<script>
window.onload = function() {
  document.getElementById("domain").focus();
}
</script>
</html>