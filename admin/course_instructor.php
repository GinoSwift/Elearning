<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/courseInstructorController.php';

$course_instructor_con = new courseInstructorController();
$course_instructors = $course_instructor_con->getCourseInstructors();

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Course_Instructor</strong> Dashboard</h1>
        <?php
        // if (isset($_GET['status']) && $_GET['status'] == 1) {
        //     echo "<div class='alert alert-success'> New category has successfully created!</div>";
        // }

        // if (isset($_GET['status']) && $_GET['status'] == 2) {
        //     echo "<div class='alert alert-success'> New category has successfully updated!</div>";
        // }
        ?>

        <div class="row mb-3">
            <div class="col-md-3">
                <a href="add_course_instructor.php" class="btn btn-dark">Add New Info</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class=" table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Instructor Name</th>
                            <th>Batch</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($course_instructors as $course_instructor) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $course_instructor['instructor_name'] . "</td>";
                            echo "<td>" . $course_instructor['batch_name'] . "</td>";
                            echo "<td> <a class='btn btn-warning mx-3' href=''>Edit</a> <a class='btn btn-danger mx-3 btn-delete' >Delete</a> </td>";
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