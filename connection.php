<?php 

$server = 'localhost';
$username = 'root';
$password = 'root';
$conn= mysqli_connect($server, $username, $password);
if(!$conn){
	// echo 'Spajanje neuspjesno';
}
$sql = "CREATE DATABASE IF NOT EXISTS mentorstvo";
$result = mysqli_query($conn,$sql);

$database = 'mentorstvo';
$conn = mysqli_connect($server, $username, $password, $database);
$sql = "CREATE TABLE IF NOT EXISTS `prijava` (
  `id` int(50) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `vrijeme` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `php` varchar(20) NOT NULL,
  `kod` varchar(8) NOT NULL UNIQUE KEY,
  `opis` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16";
$result=mysqli_query($conn, $sql);

?>