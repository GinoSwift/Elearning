<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../model/batchTrainee.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';
class BatchTraineeController extends BatchTrainee
{
    public function getBatchTrainees()
    {
        return $this->getBatchTraineesList();
    }

    public function addBatchTrainee($trainee, $batch, $date, $email, $status, $image)
    {
        if ($image['error'] == 0) {
            $fileName = $image['name'];
            $extension = explode('.', $fileName);
            $fileType = end($extension);
            $fileSize = $image['size'];
            $temp_file = $image['tmp_name'];
            $allowedTypes = ['png', 'jpg', 'jpeg', 'svg', 'avif', 'webp'];
            if (in_array($fileType, $allowedTypes)) {
                if ($fileSize <= 2000000) {
                    $timestamp  = time();
                    $fileName = $timestamp . $fileName;
                    move_uploaded_file($temp_file, '../uploads/' . $fileName);
                    return $this->createBatchTrainee($trainee, $batch, $date, $email, $status, $fileName);
                }
            }
        }
    }

    public function getBatchTrainee($id)
    {
        return $this->getBatchTraineeInfo($id);
    }

    public function editBatchTrainee($id, $date, $email, $image)
    {
        if ($image['error'] == 0) {
            $fileName = $image['name'];
            $extension = explode('.', $fileName);
            $fileType = end($extension);
            $fileSize = $image['size'];
            $temp_file = $image['tmp_name'];
            $allowedTypes = ['png', 'jpg', 'jpeg', 'svg', 'avif', 'webp'];
            if (in_array($fileType, $allowedTypes)) {
                if ($fileSize <= 2000000) {
                    $timestamp  = time();
                    $fileName = $timestamp . $fileName;
                    move_uploaded_file($temp_file, '../uploads/' . $fileName);
                    return $this->updateBatchTrainee($id, $date, $email, $fileName);
                }
            }
        }
    }

    public function deleteBatchTrainee($id)
    {
        return $this->deleteBatchTraineeInfo($id);
    }

    public function getTraineeCourse()
    {
        return $this->getTraineeNum();
    }

    public function getTraineesByBatch($bid)
    {
        return $this->getTraineesByBatchInfo($bid);
    }

    public function mailBatchTrainee($id)
    {
        $mailInfo = $this->getMail($id);
        //die(var_dump($mailInfo));
        $mailer = new PHPMailer(true);
        // server setting
        $mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;

        // mail setting
        $mailer->Username = "phillipbank2004@gmail.com";
        $mailer->Password = "fjkskigmqzjfquzh";

        // Sender and recipent setting
        $mailer->setFrom("phillipbank2004@gmail.com", "Admin");
        $mailer->addAddress($mailInfo['email'], "Batch_Trainee Name");

        $mailer->IsHTML(true);
        $mailer->Subject = "Information letter for your registeration!";
        $mailer->Body = 'Trainee Name: ' . $mailInfo['tname'] . '<br>' . 'Batch Name: ' . $mailInfo['bname'] . '<br>' . 'Joined Date: ' . $mailInfo['joined_date'] . '<br>' . 'Status: ' . $mailInfo['status'] . '<br>';

        if ($mailer->send()) {
            $sentEmail = $this->updateMail($id);
        }
        return $sentEmail;
    }
}
