<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/batchTraineeController.php';

$batchTrainee_cont = new BatchTraineeController();
$batchTrainees = $batchTrainee_cont->getBatchTrainees();

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Batch_Trainee</strong> Dashboard</h1>
        <!-- <?php
                // if (isset($_GET['status']) && $_GET['status'] == 1) {
                //     echo "<div class='alert alert-success'> New course has successfully created!</div>";
                // }

                // if (isset($_GET['status']) && $_GET['status'] == 2) {
                //     echo "<div class='alert alert-success'> New course has successfully updated!</div>";
                // }
                ?> -->

        <div class="row mb-3">
            <div class="col-md-3">
                <a href="registeration.php" class="btn btn-dark">Register New Trainee</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Trainee Name</th>
                            <th>Batch Name</th>
                            <th>Joined Date</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Actions</th>
                            <th>Sending Mail</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        for ($i = 0; $i < sizeof($batchTrainees); $i++) {
                            echo "<tr>";
                            echo "<td>" . $i + 1  . "</td>";
                            echo "<td>" . $batchTrainees[$i]['tname'] . "</td>";
                            echo "<td>" . $batchTrainees[$i]['bname'] . "</td>";
                            echo "<td>" . $batchTrainees[$i]['date'] . "</td>";
                            echo "<td>" . $batchTrainees[$i]['status'] . "</td>";
                            echo "<td>" . $batchTrainees[$i]['email'] . "</td>";
                            echo "<td><img src='../uploads/" . $batchTrainees[$i]['image'] . "' width='70px' height='70px' alt='img'></td>";
                            echo "<td id='" . $batchTrainees[$i]['id'] . "'> <a class='btn btn-warning mx-3' href='edit_registeration.php?id=" . $batchTrainees[$i]['id'] . " '>Edit</a> <a class='btn btn-danger mx-3 batrbtn_delete'>Delete</a> </td>";
                            if ($batchTrainees[$i]['smail'] == 0) {
                                echo "<td><a class='btn btn-primary' href='emailBatchTrainee.php?id=" . $batchTrainees[$i]['id'] . " ' >Email</a></td>";
                            } else {
                                echo "<td>Already sent</td>";
                            }
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