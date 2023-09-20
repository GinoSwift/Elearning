<?php
ob_start();
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/instructorController.php';
$id = $_GET['id'];

$int_con = new InstructorController();
$instructor = $int_con->getInstructor($id);
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $image = $_FILES['image'];
    $status = $int_con->editInstructor($id, $name, $email, $phone, $address, $image);
    if ($status) {
        $message = 2;
        // echo "<script> location.href='instructor.php'</script>";
        header("location:instructor.php?status=$message");
    }
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Update New Instructor</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Instructor Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $instructor['name']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $instructor['email']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="phone" name="phone" class="form-control" value="<?php echo $instructor['phone']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $instructor['address']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Featured Image</label>
                        <div>
                            <img src="../uploads/<?php echo $instructor['image']; ?>" height="100px" width="100px" alt="img">
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