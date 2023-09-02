<?php
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';
$option=array(
    PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8',
);

try {
  $db = new PDO($dsn, $username, $password,$option);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}



?>