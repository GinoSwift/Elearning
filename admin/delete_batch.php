<?php
include_once __DIR__ . '/../controller/batchController.php';

$id = $_POST['id'];
$batch_con = new batchController();
$result = $batch_con->deleteBatch($id);
if ($result) {
    echo "success";
} else {
    echo "You can't delete it as it has related child data";
}
