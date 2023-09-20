<?php
include_once __DIR__ . '/../controller/traineeController.php';
$id = $_GET['id'];
$trainee_controller = new traineeController();
$status = $trainee_controller->mailTrainee($id);
if ($status == true) {
    $message = 3;
    echo "<script>location.href='trainee.php?status=$message'</script>";
}
