<?php
$database = "praktikum9_dairy"; 
$hostname = "localhost"; 
$username = "root"; 
$password = "";

$kon = new mysqli($hostname, $username, $password, $database);

if ($kon->connect_error) {
	die("Koneksi Error : {$conn->connect_error}");
}

