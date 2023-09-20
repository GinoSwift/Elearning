<?php
include_once __DIR__ . '/../controller/batchTraineeController.php';

$id = $_POST['id'];
$batchTrainee_cont = new BatchTraineeController();
$result = $batchTrainee_cont->deleteBatchTrainee($id);
if ($result) {
    echo "success";
} else {
    echo "You can't delete it as it has related child data";
}
