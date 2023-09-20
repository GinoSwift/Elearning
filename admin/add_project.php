<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/projectController.php';
include_once __DIR__ . '/../controller/batchController.php';

$project_cont = new ProjectController();
$batch_cont = new batchController();
$batches = $batch_cont->getBatches();
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $name = $_POST['name'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $rate = $_POST['rate'];
    $status = $project_cont->addProject($title, $name, $sdate, $edate, $rate);
    //die(var_dump($status));
    if ($status == true) {
        echo '<script>location.href="ojt_project.php?Status=' . $status . '"</script>';
    }
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Add New Project</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="my-2">
                        <label for="" class="form-label">Project Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="my-2">
                        <label for="" class="form-label">Batch Name</label>
                        <select name="name" id="" class="form-select">
                            <?php
                            foreach ($batches as $batch) {
                                echo "<option value='" . $batch['id'] . "'>" . $batch['name'] . "</option>";
                            }
                            ?>

                        </select>
                    </div>

                    <div class="my-2">
                        <label for="" class="form-label">Start Date</label>
                        <input type="date" name="sdate" class="form-control">
                    </div>

                    <div class="my-2">
                        <label for="" class="form-label">End Date</label>
                        <input type="date" name="edate" class="form-control">
                    </div>

                    <div class="my-2">
                        <label for="" class="form-label">Project Rate</label>
                        <input type="text" name="rate" class="form-control">
                    </div>

                    <div>
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