<?php
session_start();
error_reporting(0);
include('koneksi.php');
if($_SESSION['alogin']!=''){
    $_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql ="SELECT username, password FROM admin WHERE Username=:username and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':username', $username, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0) {
            $_SESSION['login'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        }else{
            echo "<script>alert('Invalid Details');</script>";
        }
}
?>

