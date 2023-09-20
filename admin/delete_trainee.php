<?php
include_once __DIR__ . './../controller/traineeController.php';
$id = $_POST['id'];
$trainee_cont = new traineeController();
$trainee = $trainee_cont->deleteTrainee($id);
if ($trainee) {
    echo "success";
} else {
    echo "You can't delete is as it has related child data";
}
