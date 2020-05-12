<?php
/*$namaHost = "localhost";
$user = "root";
$password = "";
$database = "projek";
$connect  = mysqli_connect($namaHost, $user, $password, $database);*/
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','projek');
// Establish database connection.
try
{
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
    exit("Error: " . $e->getMessage());
}
?>