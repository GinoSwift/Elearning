<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/batchController.php';
include_once __DIR__ . '/../controller/courseController.php';
ob_start();
$id = $_GET['id'];
$batch_controller = new batchController();
$batch = $batch_controller->getBatch($id);
$course_con = new CourseController();
$courses = $course_con->getCourses();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $duration = $_POST['duration'];
    $fee = $_POST['fee'];
    $discount = $_POST['discount'];
    $course_name = $_POST['course_name'];
    $image = $_FILES['image'];
    $status = $batch_controller->editBatch($id, $name, $start_date, $duration, $fee, $discount, $image);
    //var_dump($status);
    //(var_dump($status));
    if ($status) {
        $message = 2;
        //echo '<script>location.href="batch.php?status=' . $message . '"</script>';
        header("location:batch.php?status=$message");
    }
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Update New Batch</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Batch Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $batch['name']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="<?php echo $batch['start_date']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Duration</label>
                        <input type="text" name="duration" class="form-control" value="<?php echo  $batch['duration']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Fee</label>
                        <input type="text" name="fee" class="form-control" value="<?php echo  $batch['fee']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Discount</label>
                        <input type="number" min="5" name="discount" class="form-control" value="<?php echo $batch['discount']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Course Name</label>
                        <select name="course_name" id="" class="form-select">
                            <?php
                            foreach ($courses as $course) {
                                if ($batch['course_id'] == $course['id']) {
                                    echo "<option value=" . $course['id'] . " selected>" . $course['name'] . "</option>";
                                } else {
                                    echo "<option value=" . $course['id'] . " >" . $course['name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Batch Featured Image</label>
                        <div>
                            <img src="../uploads/<?php echo $batch['image']; ?>" height="100px" width="100px" alt="img">
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