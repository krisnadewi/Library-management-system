<?php
session_start();
error_reporting(0);
include ('koneksi.php');
if(strlen($_SESSION['alogin'])==1)
{
    header('location:dashboard.php');
}
else {
    if (isset($_POST['add'])) {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $sql = "INSERT INTO book(BookName,CatId,AuthorId,ISBNNumber,BookPrice) VALUES(:bookname,:category,:author,:isbn,:price)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_INT);
        $query->bindParam(':price', $price, PDO::PARAM_INT);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book Listed Successfully";
            header('location:dashboard.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:dashboard.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add new</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="container">
    <div class="row" id="addnew">
        <nav class="navbar">
            <div class="col-md-12">
                <header><img src="aset/logo.png"></header>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav" style="float: right">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="member.php">Member</a></li>
                    <li><a href="#addnew">Add new</a></li>
                    <li><a href="home.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
        <h3 class="header-line" style="color: #3831d6; margin-bottom: 50px">Add New Book</h3>
        <div class="panel panel-info">
            <div class="panel-heading" style="background: #e2e2f7">
                Book Details
            </div>
            <div class="panel-body">
                <form role="form" method="post">
                    <div class="form-group">
                        <label>Book Name<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="bookname" autocomplete="off"  required />
                    </div>
                    <div class="form-group">
                        <label> Category<span style="color:red;">*</span></label>
                        <select class="form-control" name="category" required="required">
                            <option value=""> Select Category</option>
                            <?php
                            $status=1;
                            $sql = "SELECT * FROM  category where Status=:status";
                            $query = $dbh -> prepare($sql);
                            $query -> bindParam(':status',$status, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                {               ?>
                                    <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
                                <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Author<span style="color:red;">*</span></label>
                        <select class="form-control" name="author" required="required">
                            <option value=""> Select Author</option>
                            <?php

                            $sql = "SELECT * FROM  author";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                {               ?>
                                    <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->AuthorName);?></option>
                                <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ISBN Number<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="isbn"  required="required" autocomplete="off"  />
                        <p class="help-block">ISBN should be unique</p>
                    </div>

                    <div class="form-group">
                        <label>Rental Price/Day (in Rp)<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" name="price" autocomplete="off"   required="required" />
                    </div>
                    <button type="submit" name="add" class="btn btn-info" style="background: #e2e2f7; color: black">Add</button>
                </form>
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
