<?php
include_once __DIR__ . '/../model/batch.php';
class batchController extends Batch
{
    public function getBatches()
    {
        return $this->getBatchesList();
    }

    public function addBatch($name, $start_date, $duration, $fee, $discount, $course_name, $image)
    {
        if ($image['error'] == 0) {
            $fileName = $image['name'];
            $extension = explode('.', $fileName);
            $fileType = end($extension);
            $tmp_file = $image['tmp_name'];
            $fileSize = $image['size'];
            $allowed_types = ['png', 'pneg', 'svg', 'jpg'];
            if (in_array($fileType, $allowed_types)) {
                if ($fileSize <= 200000) {
                    $timestamp = time();
                    $fileName = $timestamp . $fileName;
                    move_uploaded_file($tmp_file, '../uploads/' . $fileName);
                    return $this->createBatch($name, $start_date, $duration, $fee, $discount, $course_name, $fileName);
                }
            }
        }
    }

    public function getBatch($id)
    {
        return $this->getBatchInfo($id);
    }

    public function editBatch($id, $name, $start_date, $duration, $fee, $discount, $image)
    {
        if ($image['error'] == 0) {
            $fileName = $image['name'];
            $extension = explode('.', $fileName);
            $fileType = end($extension);
            $tmp_file = $image['tmp_name'];
            $fileSize = $image['size'];
            $allowed_types = ['png', 'pneg', 'svg', 'jpg'];
            if (in_array($fileType, $allowed_types)) {
                if ($fileSize <= 200000) {
                    $timestamp = time();
                    $fileName = $timestamp . $fileName;
                    move_uploaded_file($tmp_file, '../uploads/' . $fileName);
                    return $this->updateBatch($id, $name, $start_date, $duration, $fee, $discount, $fileName);
                }
            }
        }
    }

    public function deleteBatch($id)
    {
        return $this->deleteBatchInfo($id);
    }

    public function batchPerYear()
    {
        return $this->getBatchPerYear();
    }
}
