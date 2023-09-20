<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/projectTraineesController.php';

$projectTrainee_cont = new ProjectTraineeController();
$Ptrainees = $projectTrainee_cont->getProjectTrainees();
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Project_Trainees</strong> Dashboard</h1>
        <?php

        ?>

        <div class="row">
            <div class="col-md-12">
                <table class=" table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Project Title</th>
                            <th>Trainee Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($Ptrainees as $Ptrainee) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $Ptrainee['pname'] . "</td>";
                            echo "<td>" . $Ptrainee['tname'] . "</td>";
                            echo "<td>" . $Ptrainee['status'] . "</td>";
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