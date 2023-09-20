<?php
include_once __DIR__ . '/../controller/batchController.php';

$batch_cont = new batchController();
$batch_per_year = $batch_cont->batchPerYear();

echo json_encode($batch_per_year);
