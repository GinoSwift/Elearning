<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/instructorController.php';

ob_start();
$int_controller = new InstructorController();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $image = $_FILES['image'];
    $status = $int_controller->addInstructor($name, $email, $phone, $address, $image);
    if ($status) {
        echo '<script> location.href="instructor.php?status=' . $status . '"</script>';
    }
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Add New Instructor</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Instructor Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="phone" name="phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Instructor Featured Image</label>
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