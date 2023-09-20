<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/categoryController.php';
$id = $_GET['id'];
$cat_con = new CategoryController();
$category = $cat_con->getCategory($id);
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $image = $_FILES['image'];
    $status = $cat_con->editCategory($id, $name, $image);
    if ($status) {
        $message = 2;
        echo "<script> location.href='category.php?status=" . $message . "'</script>";
    }
}

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Update New Category</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $category['name'] ?>">
                    </div>

                    <div>
                        <label for="" class="form-label">Category Featured Image</label>
                        <div>
                            <img src="../uploads/<?php echo $category['image'] ?>" width="70px" height="70px" alt="img">
                        </div>

                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-dark" name="submit">UPDATE</button>
                    </div>
                </form>

            </div>
        </div>





    </div>
</main>

<?php
include_once __DIR__ . '/../layouts/app_footer.php';
?>