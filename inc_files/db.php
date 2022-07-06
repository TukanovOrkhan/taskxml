<?php 
$db_host = 'localhost';
$db_user = 'task1';
$db_pass = '98BuFNXBUOAY1TMM';
$db_database = 'cbarbase';

try {
  $conn = new PDO("mysql:host=$db_host;dbname=$db_database; charset=utf8", $db_user, $db_pass);
  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>