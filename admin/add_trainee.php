<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/traineeController.php';

ob_start();
$trainee_cont = new traineeController();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $education = $_POST['education'];
    $remark = $_POST['remark'];
    $status = $_POST['status'];
    $image = $_FILES['image'];
    // var_dump($image);
    $status1 = $trainee_cont->addTrainee($name, $email, $phone, $city, $education, $remark, $status, $image);
    if ($status1) {
        echo '<script> location.href="trainee.php?status=' . $status1 . '"</script>';
    }
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Add New Trainee</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Trainee Name</label>
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
                        <label for="" class="form-label">city</label>
                        <input type="text" name="city" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Education</label>
                        <input type="text" name="education" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Remark</label>
                        <input type="text" name="remark" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="" class="form-select">
                            <option value="online">online</option>
                            <option value="offline">offline</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Trainee Featured Image</label>
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