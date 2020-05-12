<?php
session_start();
error_reporting(0);
include('koneksi.php');
if(strlen($_SESSION['login'])==1)
{
    header('location:dashboard.php');
}
else {

    if (isset($_POST['update'])) {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $bookid = intval($_GET['bookid']);
        $sql = "UPDATE  book set BookName=:bookname,CatId=:category,AuthorId=:author,ISBNNumber=:isbn,BookPrice=:price where id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Book info updated successfully";
        header('location:dashboard.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="container">
    <div class="row" id="dashboard">
        <nav class="navbar">
            <div class="col-md-12">
                <header><img src="aset/logo.png"></header>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav" style="float: right">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="member.php">Member</a></li>
                    <li><a href="addbook.php">Add new</a></li>
                    <li><a href="home.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
        <h3 class="header-line" style="margin-bottom: 50px; color: #3831d6">Update Book</h3>
        <div class="panel panel-info">
            <div class="panel-heading" style="background:#e2e2f7; border 1px solid #e2e2f7">
                Book Details
            </div>
            <div class="panel-body">
                <form role="form" method="post">
                    <?php
                    $bookid=intval($_GET['bookid']);
                    $sql = "SELECT book.BookName,category.CategoryName,category.id as cid,author.AuthorName,author.id as athrid,book.ISBNNumber,book.BookPrice,book.id as bookid from  book join category on category.id=book.CatId join author on author.id=book.AuthorId where book.id=:bookid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                        foreach($results as $result)
                        {
                            ?>

                            <div class="form-group">
                                <label>Book Name<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName);?>" required />
                            </div>

                            <div class="form-group">
                                <label> Category<span style="color:red;">*</span></label>
                                <select class="form-control" name="category" required="required">
                                    <option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->CategoryName);?></option>
                                    <?php
                                    $status=1;
                                    $sql1 = "SELECT * from  category where Status=:status";
                                    $query1 = $dbh -> prepare($sql1);
                                    $query1-> bindParam(':status',$status, PDO::PARAM_STR);
                                    $query1->execute();
                                    $resultss=$query1->fetchAll(PDO::FETCH_OBJ);
                                    if($query1->rowCount() > 0)
                                    {
                                        foreach($resultss as $row)
                                        {
                                            if($catname==$row->CategoryName)
                                            {
                                                continue;
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->CategoryName);?></option>
                                            <?php }}} ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label> Author<span style="color:red;">*</span></label>
                                <select class="form-control" name="author" required="required">
                                    <option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->AuthorName);?></option>
                                    <?php

                                    $sql2 = "SELECT * FROM  author";
                                    $query2 = $dbh -> prepare($sql2);
                                    $query2->execute();
                                    $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                                    if($query2->rowCount() > 0)
                                    {
                                        foreach($result2 as $ret)
                                        {
                                            if($athrname==$ret->AuthorName)
                                            {
                                                continue;
                                            } else{

                                                ?>
                                                <option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->AuthorName);?></option>
                                            <?php }}} ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>ISBN Number<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber);?>"  required="required" />
                                <p class="help-block">ISBN should be unique</p>
                            </div>

                            <div class="form-group">
                                <label>Rental Price/Day (in Rp)<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->BookPrice);?>"   required="required" />
                            </div>
                        <?php
                        }
                    }
                    ?>
                    <button type="submit" name="update" class="btn btn-info" style="background: #e2e2f7; border: 0px; color: black">Update</button>
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
</div>
</body>
</html>
