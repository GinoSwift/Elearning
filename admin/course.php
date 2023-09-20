<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/courseController.php';

$course_con = new CourseController();
$courses = $course_con->getCourses();
?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Course</strong> Dashboard</h1>
        <?php
        if (isset($_GET['status']) && $_GET['status'] == 1) {
            echo "<div class='alert alert-success'> New course has successfully created!</div>";
        }

        if (isset($_GET['status']) && $_GET['status'] == 2) {
            echo "<div class='alert alert-success'> New course has successfully updated!</div>";
        }
        ?>

        <div class="row mb-3">
            <div class="col-md-3">
                <a href="add_course.php" class="btn btn-dark">Add New Course</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Course Category</th>
                            <th>Course Outline</th>
                            <th>Action</th>
                            <th>Image</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        for ($i = 0; $i < sizeof($courses); $i++) {
                            echo "<tr>";
                            echo "<td>" . $i + 1  . "</td>";
                            echo "<td>" . $courses[$i]['name'] . "</td>";
                            echo "<td>" . $courses[$i]['catname'] . "</td>";
                            echo "<td>" . $courses[$i]['outline'] . "</td>";
                            echo "<td id='" . $courses[$i]['id'] . "'> <a class='btn btn-warning mx-3' href='edit_course.php?id=" . $courses[$i]['id'] . " '>Edit</a> <a class='btn btn-danger mx-3 cbtn_delete'>Delete</a> </td>";
                            echo "<td><img src='../uploads/" . $courses[$i]['image'] . " ' width='100px' height='100px'></td>";

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