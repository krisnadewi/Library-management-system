<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"href="home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                    <li><a href="#home">Home</a></li>
                    <li><a href="#aboutus">About Us</a></li>
                    <li><a href="#footer">Contact</a></li>
                </ul>
            </div>
</nav>
</div>
<div id="home" class="row">
    <div id="c1" class="col-md-6">
            <img src="aset/undraw_book_lover_mkck.png">
    </div>
    <div id="c2" class="col-md-6">
            <h2>Online Library</h2>
            <p>Welcome to Atlee Library Management System! <br>Please login with your admin account or sign up using your employee account.</p>
            <form method="post" action="login.php">
                <div class="container">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Login</button>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Form Login</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" class="form-horizontal">

                                        <div class="form-group">
                                            <label for="nama" class="col-sm-2 control-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="username" required ></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="pwd" required ></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10">
                                                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <form method="post" action="dashboard.php">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
<div id="aboutus" class="row">
    <div id="c2" class="col-md-6">
            <h2 style="margin-top: 125px">About Us</h2>
            <p>Atlee Library is the largest library in Bali which was built on May 2th 1995.
                <br>There are over 10.000 books in various category. <br>
                You will find the greatest literature here!</p>
    </div>
    <div id="c1" class="col-md-6">
        <img src="aset/pict3.png" style="margin-top: 50px">
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
</div>
</body>


