<?php
include_once __DIR__ . './../controller/instructorController.php';

$id = $_POST['id'];
$instructor_cont = new InstructorController();
$result = $instructor_cont->deleteInstructor($id);
if ($result) {
    echo "success";
} else {
    echo "You can't delete it as it has related child data";
}
