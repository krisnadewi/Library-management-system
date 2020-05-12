<?php
session_start();
error_reporting(0);
include('koneksi.php');
if(strlen($_SESSION['alogin'])==1)
{
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="container">
    <div class="row" id="member">
        <nav class="navbar">
            <div class="col-md-12">
                <header><img src="aset/logo.png"></header>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav" style="float: right">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="#member">Member</a></li>
                    <li><a href="addbook.php">Add new</a></li>
                    <li><a href="home.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
        <h3 class="header-line" style="color: #3831d6; margin-bottom: 50px">Member</h3>
        <div class="panel panel-info">
            <div class="panel-heading" style="background: #e2e2f7">
                Students
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Email </th>
                            <th>Registration Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sql = "SELECT * FROM student";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result)
                            {               ?>
                                <tr class="odd gradeX">
                                    <td class="center"><?php echo htmlentities($cnt);?></td>
                                    <td class="center"><?php echo htmlentities($result->StudentId);?></td>
                                    <td class="center"><?php echo htmlentities($result->FullName);?></td>
                                    <td class="center"><?php echo htmlentities($result->Email);?></td>
                                    <td class="center"><?php echo htmlentities($result->RegDate);?></td>
                                </tr>
                                <?php $cnt=$cnt+1;}} ?>
                        </tbody>
                    </table>
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
