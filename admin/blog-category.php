<?php 

require "includes/dbh.php";

$sqlCategories = "SELECT * FROM blog_category";
$queryCategories = mysqli_query($connection, $sqlCategories);
$numCategories = mysqli_num_rows($queryCategories);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Dream</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">

        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Blog Categories
                        </h1>
                    </div>
                </div>

                <?php 
                if (isset($_REQUEST['addcategory'])) {
                    if ($_REQUEST['addcategory'] == "success") {
                        echo "<div class='alert alert-success'><strong>Sukses!</strong> kategori sukses ditambahkan</div>";
                    } else if($_REQUEST['addcategory'] == "error") {
                        echo "<div class='alert alert-success'><strong>Gagal!</strong> kategori gagal ditambahkan</div>";
                    }
                } else if (isset($_REQUEST['editcategory'])) {
                    if ($_REQUEST['editcategory'] == "success") {
                        echo "<div class='alert alert-success'><strong>Sukses!</strong> kategori berhasil diubah</div>";
                    } else if($_REQUEST['editcategory'] == "error") {
                        echo "<div class='alert alert-success'><strong>Gagal!</strong> kategori gagal diubah</div>";
                    }
                } else if (isset($_REQUEST['deletecategory'])) {
                    if ($_REQUEST['deletecategory'] == "success") {
                        echo "<div class='alert alert-success'><strong>Sukses!</strong> kategori berhasil dihapus</div>";
                    } else if($_REQUEST['deletecategory'] == "error") {
                        echo "<div class='alert alert-success'><strong>Gagal!</strong> kategori gagal dihapus</div>";
                    }
                }

                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Add a category
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form role="form" method="POST" action="includes/add-category.php">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input class="form-control" name="category-name">
                                            </div>
                                            <div class="form-group">
                                                <label>Meta Title</label>
                                                <input class="form-control" name="category-meta-title">
                                            </div>
                                            <div class="form-group">
                                                <label>Category Path (lower case, no spaces)</label>
                                                <input class="form-control" name="category-path">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary" name="add-category-btn">Add category</button>
                                        </form>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->

                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                All Categories
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Meta Title</th>
                                                <th>Category Path</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $counter = 0;

                                            while ($rowCategories = mysqli_fetch_assoc($queryCategories)) {
                                                $counter++;

                                                $id = $rowCategories['id_category'];
                                                $name = $rowCategories['category_title'];
                                                $metaTitle = $rowCategories['category_meta_title'];
                                                $categoryPath = $rowCategories['category_path'];


                                                ?>
                                                <tr>
                                                    <td><?php echo $counter; ?></td>
                                                    <td><?php echo $name; ?></td>
                                                    <td><?php echo $metaTitle; ?></td>
                                                    <td><?php echo $categoryPath; ?></td>
                                                    <td>
                                                        <button class="btn btn-success popup-button" onclick="window.open('../categories.php?group=<?php echo $categoryPath; ?>', '_blank');">View</button>
                                                        <button class="btn btn-warning popup-button" data-toggle="modal" data-target="#edit<?php echo $id; ?>">Edit</button>
                                                        <button class="btn btn-danger popup-button" data-toggle="modal" data-target="#delete<?php echo $id; ?>">Delete</button>
                                                    </td>

                                                    <div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="includes/edit-category.php" method="POST">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="category-id" value="<?php echo $id; ?>">
                                                                        <div class="form-group">
                                                                            <label for="">Name</label>
                                                                            <input type="text" class="form-control" name="edit-category-name" value="<?php echo $name ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Meta Title</label>
                                                                            <input type="text" class="form-control" name="edit-category-meta-title" value="<?php echo $metaTitle ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Category Path</label>
                                                                            <input type="text" class="form-control" name="edit-category-path" value="<?php echo $categoryPath ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                        <button type="submit" class="btn btn-primary" name="edit-category-btn">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="includes/delete-category.php" method="POST">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title" id="myModalLabel">Delete Category</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="category-id" value="<?php echo $id; ?>">
                                                                        <p>Are you sure that you want to delete this category?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                        <button type="submit" class="btn btn-danger" name="delete-category-btn">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>

                                                <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 
                <!-- /. ROW  -->
                <?php include 'footer.php'; ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    

</body>
</html>
