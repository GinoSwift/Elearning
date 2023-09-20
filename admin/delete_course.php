<?php
include_once __DIR__ . '/../controller/courseController.php';

$id = $_POST['id'];
$course_cont = new CourseController();
$result = $course_cont->deleteCourse($id);
if ($result) {
    echo "success";
} else {
    echo "You can't delete it as it has related child data";
}
