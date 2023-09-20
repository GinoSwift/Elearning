<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/categoryController.php';

ob_start();
$cat_controller = new CategoryController();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $image = $_FILES['image'];
    $status = $cat_controller->addCategory($name, $image);
    if ($status) {
        echo '<script> location.href="category.php?status=' . $status . '"</script>';
    }
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Add New Category</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div>
                        <label for="" class="form-label">Category Featured Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-dark" name="submit">ADD</button>
                    </div>
                </form>

            </div>
        </div>





    </div>
</main>

<?php
include_once __DIR__ . '/../layouts/app_footer.php';
?>