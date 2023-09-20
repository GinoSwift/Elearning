<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../model/trainee.php';
class traineeController extends Trainee
{
    public function getTrainees()
    {
        return $this->getTraineesList();
    }

    public function addTrainee($name, $email, $phone, $city, $education, $remark, $status, $image)
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
                    return $this->createTrainee($name, $email, $phone, $city, $education, $remark, $status, $fileName);
                }
            }
        }
    }

    public function getTrainee($id)
    {
        return $this->getTraineeInfo($id);
    }

    public function editTrainee($id, $name, $email, $phone, $city, $education, $remark, $status, $image)
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
                    return $this->updateTrainee($id, $name, $email, $phone, $city, $education, $remark, $status, $fileName);
                }
            }
        }
    }

    public function deleteTrainee($id)
    {
        return $this->deleteTraineeInfo($id);
    }

    public function mailTrainee($id)
    {
        $mailaddress = $this->getMail($id);
        $mailer = new PHPMailer(true);
        $mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;

        $mailer->Username = "hlaingphillip@gmail.com";
        $mailer->Password = "";
        $mailer->setFrom("phillipbank2004@gmail.com", "Admin");
        $mailer->addAddress("hlaingphillip@gmail.com", "TraineeName");

        $mailer->isHTML(true);
        $mailer->Subject = "Testing for email";
        $mailer->Body = 'testing';

        if ($mailer->send()) {
            return true;
        }
    }
}
