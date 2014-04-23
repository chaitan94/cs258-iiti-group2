<!DOCTYPE html>
<html>
<head>
  <title>Install e-procurement</title>
</head>
<body>

Install script for the website<br>
Initializes the database<br>
Should be run atleast once<br>
<b style="color:red">Note: this will update your database schema but data stored inside will be lost</b><br>
<br>
Input your database settings below:<br>
<form method="POST">
<table>
  <tr>
    <td>Host</td>
    <td><input type="text" name="host" value="localhost"></td>
  </tr>
  <tr>
    <td>User</td>
    <td><input type="text" name="user" value="root"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="pass" value=""></td>
  </tr>
  <tr>
    <td><input type="submit"></td>
  </tr>
</table>
</form>
<?php
session_start();
session_destroy();
if(isset($_POST['host']) && isset($_POST['user']) && isset($_POST['pass'])){
  $db = $_POST;
  try{
    $db = new PDO("mysql:host=".$db['host'],$db['user'],$db['pass']);
  }catch(Exception $e){
    die("<b style='color:red;'>Login Failed.</b>");
  }
  $dbname = 'eprocdb';

  $sqldb = "-- Database: `$dbname`
CREATE DATABASE IF NOT EXISTS `$dbname`;";
  if($db->query($sqldb)){
    echo "<b>Database name is `$dbname`.<br></b>";
  }else{
    echo "<b style='color:red;'>Initialization of database failed!</b>";
    die(var_dump($db->errorInfo()));
  }

  function initTable($db,$dbname,$sql,$tablename){
    if($db->query("DROP TABLE `$dbname`.$tablename")){
      echo "<b>old $tablename table dropped.<br></b>";
    }
    if($db->query("CREATE TABLE ".$sql)){
      echo "<b>$tablename table created.<br></b>";
      return true;
    }else{
      echo "<b style='color:red;'>$tablename could not be created/updated.<br></b>";
      echo "<b>Error log:</b><br>";
      die(var_dump($db->errorInfo()));
      return false;
    }
  }

  $sqltenders = "`$dbname`.`tenders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `brief` text,
  `emd` text NOT NULL,
  `category` text,
  `startdate` text,
  `starttime` text,
  `closedate` text,
  `closetime` text,
  `ownerid` int(11) NOT NULL,
  `open` BOOLEAN NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);";
  initTable($db,$dbname,$sqltenders,"tenders");

  $sqlusers = "`$dbname`.`users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `pass` text,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `type` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);";
  initTable($db,$dbname,$sqlusers,"users");

  $sqltenderuser = "`$dbname`.`tender_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenderid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);";
  initTable($db,$dbname,$sqltenderuser,"tender_user");
  $db = null;
}

if(!file_exists('data')) mkdir('data');
if(!file_exists('data/tenders')) mkdir('data/tenders');
if(!file_exists('data/tender_applications')) mkdir('data/tender_applications');
?>
<br><a href="/">Click here to go to home page</a>
</body>
</html>