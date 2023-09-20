<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/traineeController.php';
include_once __DIR__ . '/../controller/batchController.php';
include_once __DIR__ . '/../controller/batchTraineeController.php';

$trainee_cont = new traineeController();
$trainees = $trainee_cont->getTrainees();
$batch_cont = new batchController();
$batches = $batch_cont->getBatches();

$batchTrainee_cont = new BatchTraineeController();

if (isset($_POST['submit'])) {
    $trainee = $_POST['trainee'];
    $batch = $_POST['batch'];
    $date = $_POST['date'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $image = $_FILES['image'];
    $status1 = $batchTrainee_cont->addBatchTrainee($trainee, $batch, $date, $email, $status, $image);
    //die(var_dump($status1));
    if ($status1 == true) {
        $message = 3;
        echo '<script> location.href="batchTrainee.php?status=' . $message . '"</script>';
    }
}

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Registeration</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Trainee Name</label>
                        <select name="trainee" id="" class="form-select">
                            <?php
                            foreach ($trainees as $trainee) {
                                echo "<option value='" . $trainee['id'] . "'>" . $trainee['name'] . "</option>";
                            }
                            ?>

                        </select>
                    </div>

                    <div>
                        <label for="" class="form-label">Batch Name</label>
                        <select name="batch" id="" class="form-select">
                            <?php
                            foreach ($batches as $batch) {
                                echo "<option value='" . $batch['id'] . "'>" . $batch['name'] . "</option>";
                            }
                            ?>

                        </select>
                    </div>

                    <div>
                        <label for="" class="form-label">Joined Date</label>
                        <input type="date" name="date" id="" class="form-control">
                    </div>

                    <div>
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" id="" class="form-control">
                    </div>


                    <div>
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="" class="form-select">
                            <?php
                            echo "<option value='online'>online</option>";
                            echo "<option value='offline'>offline</option>";
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="" class="form-label">Batch Trainee Featured Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>



                    <div class="mt-3">
                        <button class="btn btn-dark" name="submit">Register</button>
                    </div>
                </form>

            </div>
        </div>





    </div>
</main>

<?php
include_once __DIR__ . '/../layouts/app_footer.php';
?>