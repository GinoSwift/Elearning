<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

include_once  __DIR__ . '/../model/instructor.php';


class InstructorController extends Instructor
{
    public function getInstructors()
    {
        return $this->getInstructorsList();
    }

    public function addInstructor($name, $email, $phone, $address, $image)
    {
        if ($image['error'] == 0) {
            $filename = $image['name'];
            $extension = explode('.', $filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $temp_file = $image['tmp_name'];
            $allowed_types = ['jpg', 'jpeg', 'svg', 'png'];
            if (in_array($filetype, $allowed_types)) {
                $timestamp = time();
                $filename = $timestamp . $filename;
                if ($filesize <= 2000000) {
                    move_uploaded_file($temp_file, '../uploads/' . $filename);
                    return $this->createInstructor($name, $email, $phone, $address, $image);
                }
            }
        }
    }

    public function getInstructor($id)
    {
        return $this->getInstructorInfo($id);
    }

    public function editInstructor($id, $name, $email, $phone, $address, $image)
    {
        if ($image['error'] == 0) {
            $filename = $image['name'];
            $extension = explode('.', $filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $temp_file = $image['tmp_name'];
            $allowed_types = ['jpg', 'jpeg', 'svg', 'png'];
            if (in_array($filetype, $allowed_types)) {
                $timestamp = time();
                $filename = $timestamp . $filename;
                if ($filesize <= 2000000) {
                    move_uploaded_file($temp_file, '../uploads/' . $filename);
                    return $this->updateInstructor($id, $name, $email, $phone, $address, $filename);
                }
            }
        }
    }

    public function deleteInstructor($id)
    {
        return $this->deleteInstructorInfo($id);
    }

    // public function mailInstructor($id)
    // {
    //     $mailAddress = $this->getMail($id);
    //     $mailer = new PHPMailer(true);
    //     // server setting
    //     $mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    //     $mailer->isSMTP();
    //     $mailer->Host = 'smtp.gmail.com';
    //     $mailer->SMTPAuth = true;
    //     $mailer->SMTPSecure = 'tls';
    //     $mailer->Port = 587;

    //     // mail setting
    //     $mailer->Username = "phillipbank2004@gmail.com";
    //     $mailer->Password = "fjkskigmqzjfquzh";

    //     // Sender and recipent setting
    //     $mailer->setFrom("phillipbank2004@gmail.com", "Admin");
    //     $mailer->addAddress("hlaingputh@gmail.com", "InstructorName");

    //     $mailer->IsHTML(true);
    //     $mailer->Subject = "Testing for email";
    //     $mailer->Body = 'testing';

    //     if ($mailer->send()) {
    //         return true;
    //     }
    // }
}
