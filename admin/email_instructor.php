<?php
include_once __DIR__ . '/../controller/instructorController.php';
$id = $_GET['id'];
$instructor_cont = new InstructorController();
$status = $instructor_cont->mailInstructor($id);
if ($status == true) {
    $message = 3;
    echo "<script>location.href='instructor.php?status= " . $message . "'</script>";
}
