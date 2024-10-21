<?php
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

echo "<style>.input {border:1px solid lightgrey;border-collapse:collapse;text-align:center;white-space:nowrap;height:30px;width:300px} tr.input:nth-child(even) {background: lightgrey;} tr.input:nth-child(odd) {background: white;} .icon-btn {color:black;font-size:150%} .submit {height:40px;background:grey;border:0px;width:200px;font-weight:bold;font-size:16px;color:white} .submit:hover {background:black}</style>";
echo "<form method='post'>";
echo "<table align='center' style='margin-top:10vh;table-layout:fixed'>";
echo "<tr><th>Domain*</th><td>&nbsp&nbsp<input type='textbox' name='newdomain' class='input' value='".$config['system']['domain']."'/></td></tr>";
echo "<tr><th>Title*</th><td>&nbsp&nbsp<input type='textbox' name='newtitle' class='input' value='".$config['system']['title']."'/></td></tr>";
echo "<tr><th>Footer*</th><td>&nbsp&nbsp<input type='textbox' name='newfooter' class='input' value='".$config['system']['footer']."'/></td></tr>";
echo "<tr><th>Background</th><td>&nbsp&nbsp<input type='textbox' name='newbackground' class='input' value='".$config['system']['background']."'/></td></tr>";
echo "<tr><th>Logo</th><td>&nbsp&nbsp<input type='textbox' name='newlogo' class='input' value='".$config['system']['logo']."'/></td></tr>";
echo "<tr><th>Logo 2</th><td>&nbsp&nbsp<input type='textbox' name='newlogo2' class='input' value='".$config['system']['logo2']."'/></td></tr>";
echo "<tr><th>Favicon</th><td>&nbsp&nbsp<input type='textbox' name='newfavicon' class='input' value='".$config['system']['favicon']."'/></td></tr>";
echo "<tr><td style='text-align:right' colspan=2><button type='submit' class='submit' name='submit'>Update</button></td></tr>";
echo "</table>";
echo "</form>";

if(isset($_POST['submit']) && $newdomain!='' && $newtitle!='' && $newfooter!=''){
    echo "<table style='background:lightgreen' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid green;color:green'>Setting has been updated successfully!</td></tr></table>";
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
    echo "<table style='background:pink' align='center'><tr height='50px'><td width='400px' align='center' style='border:1px solid red;color:red'>Please fill in all the fields!</td></tr></table>";
}
?>