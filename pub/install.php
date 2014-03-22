<!DOCTYPE html>
<html>
<head>
  <title>Install e-procurement</title>
</head>
<body>

Install script for the website<br>
Initializes the database<br>
Should be run atleast once<br>
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
if(isset($_POST['host']) && isset($_POST['user']) && isset($_POST['pass'])){
  $db = $_POST;
  try{
    $db = new PDO("mysql:host=".$db['host'],$db['user'],$db['pass']);
  }catch(Exception $e){
    die("<b style='color:red;'>Login Failed.</b>");
  }
  $dbname = 'eprocdb';

$schema = <<<END
-- Database: `$dbname`
CREATE DATABASE IF NOT EXISTS `$dbname`;

-- Table structure for table `$dbname`.`tenders`
CREATE TABLE IF NOT EXISTS `$dbname`.`tenders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `brief` text,
  `emd` text NOT NULL,
  `category` text,
  `startdate` text,
  `starttime` text,
  `closedate` text,
  `closetime` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- Table structure for table `$dbname`.`users`
CREATE TABLE IF NOT EXISTS `$dbname`.`users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `pass` text,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;
END;

  if($db->query($schema)){
    echo "<b>Database initialized successfully</b>";
  }else{
    echo "<b style='color:red;'>Database initialization failed!</b>";
    var_dump($db->errorInfo());
  }
  $db = null;
}
?>
<br><a href="/">Click here to go to home page</a>
</body>
</html>