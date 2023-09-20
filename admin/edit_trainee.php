<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/traineeController.php';

$id = $_GET['id'];
$trainee_cont = new traineeController();
$trainee = $trainee_cont->getTrainee($id);
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $education = $_POST['education'];
    $remark = $_POST['remark'];
    $status = $_POST['status'];
    $image = $_FILES['image'];
    //var_dump($image);
    $status2 = $trainee_cont->editTrainee($id, $name, $email, $phone, $city, $education, $remark, $status, $image);
    //var_dump($status2);
    if ($status2 == true) {
        $message = 2;
        echo '<script> location.href="trainee.php?status=' . $message . '"</script>';
    }
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Update New Trainee</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Trainee Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $trainee['name']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $trainee['email']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="phone" name="phone" class="form-control" value="<?php echo $trainee['phone']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">city</label>
                        <input type="text" name="city" class="form-control" value="<?php echo $trainee['city']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Education</label>
                        <input type="text" name="education" class="form-control" value="<?php echo $trainee['education']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Remark</label>
                        <input type="text" name="remark" class="form-control" value="<?php echo $trainee['remark']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="" class="form-select">
                            <?php
                            if ($trainee['status'] == "online") {
                                echo "<option value='online' selected >online</option>";
                                echo "<option value='offline'>offline</option>";
                            } else {
                                echo "<option value='online'>online</option>";
                                echo "<option value='offline' selected >offline</option>";
                            }

                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Trainee Featured Image</label>
                        <div class="my-3">
                            <img src="../uploads/<?php echo $trainee['image']; ?>" class="image-fluid" width="100px" height="100px" alt="image">
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