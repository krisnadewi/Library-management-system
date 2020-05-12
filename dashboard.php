<?php
session_start();
error_reporting(0);
include('koneksi.php');
if(strlen($_SESSION['login'])==1)
{
    header('location:dashboard.php');
}
else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM book WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Category deleted successfully";
        header('location:dashboard.php');

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
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
                    <li><a href="#dashboard">Dashboard</a></li>
                    <li><a href="member.php">Member</a></li>
                    <li><a href="addbook.php">Add new</a></li>
                    <li><a href="home.php">Log out</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="row pad-botm">
        <div class="col-md-12">
            <h3 class="header-line" style="color: #3831d6; margin-bottom: 50px">Manage Books</h3>
        </div>
    </div>
        <div class="row">
            <?php if ($_SESSION['error'] != "") {
                ?>
                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <strong>Error :</strong>
                        <?php echo htmlentities($_SESSION['error']); ?>
                        <?php echo htmlentities($_SESSION['error'] = ""); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if ($_SESSION['msg'] != "") {
                ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong>
                        <?php echo htmlentities($_SESSION['msg']); ?>
                        <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if ($_SESSION['updatemsg'] != "") {
                ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong>
                        <?php echo htmlentities($_SESSION['updatemsg']); ?>
                        <?php echo htmlentities($_SESSION['updatemsg'] = ""); ?>
                    </div>
                </div>
            <?php } ?>


            <?php if ($_SESSION['delmsg'] != "") {
                ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong>
                        <?php echo htmlentities($_SESSION['delmsg']); ?>
                        <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Books Listing
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Book Name</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Rental Price/Day (in Rp)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sql = "SELECT book.BookName,category.CategoryName,author.AuthorName,book.ISBNNumber,book.BookPrice,book.id as bookid from  book join category on category.id=book.CatId join author on author.id=book.AuthorId";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                            <tr class="odd gradeX">
                                <td class="center"><?php echo htmlentities($cnt); ?></td>
                                <td class="center"><?php echo htmlentities($result->BookName); ?></td>
                                <td class="center"><?php echo htmlentities($result->CategoryName); ?></td>
                                <td class="center"><?php echo htmlentities($result->AuthorName); ?></td>
                                <td class="center"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                <td class="center"><?php echo htmlentities($result->BookPrice); ?></td>
                                <td class="center">
                                    <a href="edit.php?bookid=<?php echo htmlentities($result->bookid); ?>">
                                        <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button>
                                        <a href="dashboard.php?del=<?php echo htmlentities($result->bookid); ?>"
                                           onclick="return confirm('Are you sure you want to delete?');"" >
                                        <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                </td>
                            </tr>
                            <?php $cnt = $cnt + 1;
                            }
                            }?>
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
</div>
</body>
</html>