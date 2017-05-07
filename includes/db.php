<?php

$host = "localhost";
$user = "root";
$db = "cms";
$password = "root";


$dsn = "mysql:host=$host;dbname=$db";

$conn = new PDO($dsn, $user, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);