<?php
session_start();
error_reporting(0);
include('koneksi.php');
if(isset($_POST['signup']))
{
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="INSERT INTO  admin(fullname,email,username,password) VALUES(:fullname,:email,:username,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo "<script>alert('Something went wrong. Please try again later');</script>";
    }
    else
    {
        echo '<script>alert("Success!")</script>';
        echo "<script type='text/javascript'> document.location ='home.php'; </script>";
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"href="home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Admin Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
        function valid()
        {
            if(document.signup.password.value!= document.signup.confirmpassword.value)
            {
                alert("Password and Confirm Password Field do not match  !!");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data:'username='+$("#username").val(),
                type: "POST",
                success:function(data){
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }
    </script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="container">
    <div class="row">
        <nav class="navbar">
            <div class="col-md-12">
                <header><img src="aset/logo.png"></header>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav" style="float: right">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="home.php">About Us</a></li>
                    <li><a href="#footer">Contact</a></li>
                </ul>
            </div>
        </nav>
    </div>
<div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
        </div>
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-danger" style="border: 1px solid #e2e2f7">
                    <div class="panel-heading" style="background: #e2e2f7; color: black;">
                        SIGN UP FORM
                    </div>
                    <div class="panel-body">
                        <form name="signup" method="post" onSubmit="return valid();">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="fullname" autocomplete="off" required/>
                            </div>
                            <div class="form-group">
                                <label>Email </label>
                                <input class="form-control" type="text" name="email" maxlength="50" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" id="username" onBlur="checkAvailability()"  autocomplete="off" required  />
                                <span id="user-availability-status" style="font-size:12px;"></span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label>Confirm Password </label>
                                <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required />
                            </div>
                            <form method="post" action="home.php">
                                <button type="submit" name="signup" class="btn btn-danger" id="submit" style="background: #e2e2f7; color: black; border: #e2e2f7">Sign Up</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div id="footer" class="col-md-12">
            <footer>
                <h4>Atlee Library</h4>
                <p>Jl.Singaraja-Amlapura, Buleleng, Bali</p>
                <p>Telp.0361 22345</p>
                <p>Atlee@gmail.com</p>
            </footer>
        </div>
    </div>
</body>
</html>
