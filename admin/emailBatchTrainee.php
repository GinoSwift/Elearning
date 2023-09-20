<?php
include_once __DIR__ . '/../controller/batchTraineeController.php';
$id = $_GET['id'];
$batchTrainee_cont = new BatchTraineeController();
$status = $batchTrainee_cont->mailBatchTrainee($id);
//die(var_dump($status));
if ($status == true) {
    $message = 3;
    echo "<script>location.href='batchTrainee.php?status= " . $message . "'</script>";
}
