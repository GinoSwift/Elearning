<?php
include_once __DIR__ . '/../controller/batchTraineeController.php';
$batch_id = $_POST['id'];
$trainee_con = new BatchTraineeController();
$trainees = $trainee_con->getTraineesByBatch($batch_id);

$html = "";
$html .= "<div class='row my-2'>";
$html .= "<div class='col-md-8'>";
$html .= "<div>";
$html .= ' <label for="" class="form-label"><strong>Trainee Name</strong></label>';
$html .= '<select name="trainee[]" class="form-select">';
foreach ($trainees as $trainee) {
    $html .= '<option value="' . $trainee['tid'] . '">' . $trainee['tname'] . '</option>';
}
$html .= '</select>';
$html .= "</div>";
$html .= '<div class="my-3">
<label for="" class="form-label"><strong>Status</strong></label>
<input type="text" name="status[]" class="form-control">
</div>';
$html .= "</div>";
$html .= "<div class='col-md-2' id='removebtn'><button class='btn btn-danger'>Remove</button></div>";
$html .= "</div>";

echo $html;
