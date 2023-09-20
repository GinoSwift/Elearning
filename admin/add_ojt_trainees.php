<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/batchTraineeController.php';
include_once __DIR__ . '/../controller/projectController.php';
include_once __DIR__ . '/../controller/projectTraineesController.php';

$pid = $_GET['id'];

$project_cont = new ProjectController();
$project = $project_cont->getProject($pid);
$batch_id = $project['bid'];
$batchTrainee_cont = new BatchTraineeController();
$trainees = $batchTrainee_cont->getTraineesByBatch($batch_id);

$projectTrainee_cont = new ProjectTraineeController();

$project_id = $project['id'];

if (isset($_POST['submit'])) {
    $trainee[] = $_POST['trainee'];
    $status[] = $_POST['status'];
    //die(var_dump($trainee, $status)); //pass
    $result = $projectTrainee_cont->addProjectTrainee($project_id, $trainee, $status);
    die(var_dump($result));
}

?>


<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Select Trainee</strong> Dashboard</h1>

        <div class="row">
            <div class="col-md-6">
                <p>Project Title: <strong><?php echo $project['name'] ?></strong></p>
                <p>Start Date: <strong><?php echo $project['start_date'] ?></strong></p>
                <p>Batch Name: <strong><?php echo $project['bname'] ?></strong></p>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">



                    <div class="rows">
                        <div class="row my-3">
                            <div class="col-md-8">
                                <div>
                                    <label for="" class="form-label"><strong>Trainee Name</strong></label>
                                    <select name="trainee[]" id="<?php echo $project['id'] ?>" class="form-select">
                                        <?php
                                        foreach ($trainees as $trainee) {
                                            echo "<option value='" . $trainee['tid'] . "'>" . $trainee['tname'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="my-3">
                                    <label for="" class="form-label"><strong>Status</strong></label>
                                    <input type="text" name="status[]" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-2" id="<?php echo $batch_id; ?>">
                                <button class="btn btn-primary addbtn">ADD MORE</button>
                            </div>
                        </div>
                    </div>




                    <div class="my-3">
                        <button class="btn btn-success" name="submit">Submit</button>
                    </div>



                </form>

            </div>
        </div>





    </div>

</main>



<?php
include_once __DIR__ . '/../layouts/app_footer.php';
?>