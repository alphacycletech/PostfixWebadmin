<?php
include('config.php');
session_start();
$name=$_SESSION['name'];
$user=$_SESSION['user'];
$token=$_GET['token'];
$update=$_GET['update'];
echo "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>";
echo "<title>".$title."</title>";
echo "<link href='".$favicon."' rel='icon' type='image/x-icon' />";
echo "<body style='background:url(".$background.");background-attachment:fixed;background-size:cover'>";

if(!isset($_SESSION['login']) OR $_SESSION['login']!=$_GET['token']){
    session_unset();
    header('Location:index.php');
}

echo "<a href='setting.php' target='link'><img src='".$logo2."' width=5% style='float:left'></a>";
echo "<b class='name'>Welcome, ".$name."</b>";
echo "<p align='center' class='title'><b>Webmail Administration</b></p>";

echo "<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: grey;
  font-size:2.5vh;
}

li {
  float: left;
  width:14.2857%;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 8px;
  text-decoration: none;
}

li a:hover {
  background-color: #111111;
}

@media (max-width: 600px) {
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: grey;
  font-size:1vh;
}

li a {
  display: table-cell;
  color: white;
  justify-content: center;
  align-items: center;
  padding: 8px;
  text-decoration: none;
}
}

b.name {
  float:right;
  font-size:3vh;
}

p.title {
    color:black;
    font-size:2.5vw;
}

@media (max-width: 600px) {
b.name {
  float:right;
  font-size:1.5vh;
}

p.title {
    color:black;
    font-size:1.5vh;
}

}

</style>";

echo "<ul>
  <li><a href='modify.php?user=".$user."' target='link'>Change Password</a></li>
  <li><a href='list.php' target='link'>List Users</a></li>
  <li><a href='adduser.php' target='link'>Add Users</a></li>
  <li><a href='listforwarder.php' target='link'>List Forwarders</a></li>
  <li><a href='addforwarder.php' target='link'>Add Forwarders</a></li>
  <li><a href='update.php' target='link'>Check For Update</a></li>
  <li><a href='logout.php'>Logout</a></li>";
echo "</ul>";

echo "<iframe src='' name='link' style='display:block;border:none;width:100%;height:75%;align:center'></iframe>";

echo "<style>.footer {  position: fixed;right: 0;bottom: -3%;left: 0;padding: 1rem;background:rgba(0,0,0,0);text-align: center;} .update {  position: fixed;right: 0;bottom: -3%;left: 0;padding: 1rem;background:rgba(0,0,0,0);text-align: right;}</style>";

echo "<footer><p class='footer'>".$footer."</p></footer>";

?>