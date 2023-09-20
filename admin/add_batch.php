<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/batchController.php';
include_once __DIR__ . '/../controller/courseController.php';

ob_start();
$batch_controller = new batchController();
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
    // var_dump($image);
    $status = $batch_controller->addBatch($name, $start_date, $duration, $fee, $discount, $course_name, $image);
    if ($status) {
        echo '<script> location.href="batch.php?status=' . $status . '"</script>';
    }
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Add New Batch</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Batch Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Duration</label>
                        <input type="text" name="duration" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Fee</label>
                        <input type="text" name="fee" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Discount</label>
                        <input type="number" min="5" name="discount" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Course Name</label>
                        <select name="course_name" id="" class="form-select">
                            <?php
                            foreach ($courses as $course) {
                                echo "<option value=" . $course['id'] . ">" . $course['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Batch Featured Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="">
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