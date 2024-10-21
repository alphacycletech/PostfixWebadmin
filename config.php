<?php
$config = parse_ini_file('config.ini', true);
$database='/www/vmail/postfixadmin.db';
$domain=$config['system']['domain'];
$title=$config['system']['title'];
$sub_title=$title;
$footer=$config['system']['footer'];
$background=$config['system']['background'];
$logo=$config['system']['logo'];
$logo2=$config['system']['logo2'];
$favicon=$config['system']['favicon'];
?>