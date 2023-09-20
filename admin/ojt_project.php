<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/projectController.php';

$project_cont = new ProjectController();
$projects = $project_cont->getProjects();

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Category</strong> Dashboard</h1>
        <?php
        // if (isset($_GET['status']) && $_GET['status'] == 1) {
        //     echo "<div class='alert alert-success'> New category has successfully created!</div>";
        // }

        // if (isset($_GET['status']) && $_GET['status'] == 2) {
        //     echo "<div class='alert alert-success'> New category has been successfully updated!</div>";
        // }
        ?>

        <div class="row mb-3">
            <div class="col-md-3">
                <a href="add_project.php" class="btn btn-dark">Add New Project</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class=" table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Project Title</th>
                            <th>Batch Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Project Rate</th>
                            <th>Add Trainees</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($projects as $project) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $project['pname'] . "</td>";
                            echo "<td>" . $project['bname'] . "</td>";
                            echo "<td>" . $project['sdate'] . "</td>";
                            echo "<td>" . $project['edate'] . "</td>";
                            echo "<td>" . $project['prate'] . "</td>";
                            echo "<td><a class='btn btn-info' href='add_ojt_trainees.php?id=" . $project['id'] . "'>TRAINEE</a></td>";
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