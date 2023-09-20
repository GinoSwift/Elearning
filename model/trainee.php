<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../vendor/db/db.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';


class Trainee
{
    public function getTraineesList()
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from trainee";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createTrainee($name, $email, $phone, $city, $education, $remark, $status, $fileName)
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "INSERT INTO `trainee`(`name`, `email`, `phone`, `city`, `education`, `remark`, `status`,`image`) VALUES (:name,:email,:phone,:city,:education,:remark,:status,:image)";
        $statement = $con->prepare($sql);

        try {
            $statement->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':city' => $city,
                ':education' => $education,
                ':remark' => $remark,
                ':status' => $status,
                ':image' => $fileName
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        };
    }

    public function getTraineeInfo($id)
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from trainee where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    // public function updateTrainee($id, $name, $email, $phone, $city, $education, $remark, $status1)
    // {
    //     //1.db connection
    //     $con = Database::connect();
    //     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     //2.write sql
    //     $sql = "UPDATE `trainee` SET name=:name,email=:email,phone=:phone,city=:city,education=:education,remark=:remark,status1=:status1 WHERE id=:id";
    //     $statement = $con->prepare($sql);
    //     try {
    //         $statement->execute([
    //             ':id' => $id,
    //             ':name' => $name,
    //             ':email' => $email,
    //             'phone' => $phone,
    //             'city' => $city,
    //             'education' => $education,
    //             'remark' => $remark,
    //             'status1' => $status1
    //         ]);
    //         return true;
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }

    public function updateTrainee($id, $name, $email, $phone, $city, $education, $remark, $status, $fileName)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "UPDATE trainee SET name=:name,email=:email,phone=:phone,city=:city,education=:education,remark=:remark,status=:status,image=:image WHERE id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':city', $city);
        $statement->bindParam(':education', $education);
        $statement->bindParam(':remark', $remark);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':image', $fileName);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTraineeInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "delete from trainee where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getMail($id)
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from trainee where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['email'];
        }
    }
}
