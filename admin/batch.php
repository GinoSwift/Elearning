<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/batchController.php';

$batch_cont = new batchController();
$batches = $batch_cont->getBatches();
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Batch</strong> Dashboard</h1>
        <?php
        if (isset($_GET['status']) && $_GET['status'] == 1) {
            echo "<div class='alert alert-success'> New batch has successfully created!</div>";
        }

        if (isset($_GET['status']) && $_GET['status'] == 2) {
            echo "<div class='alert alert-success'> New batch has been successfully updated!</div>";
        }
        ?>

        <div class="row mb-3">
            <div class="col-md-3">
                <a href="add_batch.php" class="btn btn-dark">Add New Batch</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>Duration</th>
                            <th>Fee</th>
                            <th>Discount</th>
                            <th>Course Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($batches as $batch) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $batch['name'] . "</td>";
                            echo "<td '>" . $batch['start_date'] . "</td>";
                            echo "<td>" . $batch['duration'] . "</td>";
                            echo "<td>" . $batch['fee'] . "</td>";
                            echo "<td>" . $batch['discount'] . "</td>";
                            echo "<td>" . $batch['course_name'] . "</td>";
                            echo "<td><img src='../uploads/" . $batch['image'] . "' width='70px' height='70px'></td>";
                            echo "<td id='" . $batch['id'] . "'> <a class='btn btn-warning mx-3' href='edit_batch.php?id=" . $batch['id'] . "' >Edit</a> <a class='btn btn-danger mx-3 bbtn_delete'>Delete</a> </td>";

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>





    </div>
</main>

<?php
include_once __DIR__ . '/../layouts/app_footer.php';
?>