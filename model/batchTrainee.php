<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../vendor/db/db.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';
include_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';

class BatchTrainee
{
    public function getBatchTraineesList()
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "select batch_trainee.id as id,trainee.name as tname,batch_trainee.sending_mail as smail,batch.name as bname,batch.id as bid,batch_trainee.joined_date as date,batch_trainee.status as status,batch_trainee.email as email,batch_trainee.image as image
        from batch_trainee join trainee join batch
        on batch_trainee.trainee_id = trainee.id and batch_trainee.batch_id = batch.id";
        $statement = $con->prepare($sql);
        //3.sql execute 
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll()=> multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createBatchTrainee($trainee, $batch, $date, $email, $status, $fileName)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "insert into batch_trainee(trainee_id,batch_id,joined_date,email,status,image) values(:trainee,:batch,:date,:email,:status,:image)";
        $statement = $con->prepare($sql);
        try {
            $statement->execute([
                ':trainee' => $trainee,
                ':batch' => $batch,
                ':date' => $date,
                ':email' => $email,
                ':status' => $status,
                ':image' => $fileName
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getBatchTraineeInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from batch_trainee where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateBatchTrainee($id, $date, $email, $fileName)
    {
        // 1. db connection
        $con = Database::connect(); // Create db connection
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error handling mode
        $sql = "UPDATE batch_trainee SET id = :id, joined_date = :date, email = :email, image = :image WHERE id = :id";
        // 2. prepare statement
        $statement = $con->prepare($sql);
        try {
            // 3. execute statement with parameter binding
            $statement->execute([
                ':id' => $id,
                ':date' => $date,
                ':email' => $email,
                ':image' => $fileName
            ]);
            // 4. return result from execute function
            return true;
        } catch (PDOException $e) {
            // 5. return false if there was an error
            return false;
        }
    }


    public function deleteBatchTraineeInfo($id)
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "delete from batch_trainee where id=:id";
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
        $sql = "select trainee.name as tname,batch.name as bname,batch_trainee.joined_date as joined_date,batch_trainee.status as status,batch_trainee.email as email
        ,batch_trainee.sending_mail as smail
        from batch_trainee join trainee join batch
        on batch_trainee.trainee_id = trainee.id and batch_trainee.batch_id = batch.id where batch_trainee.id = :id
        ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateMail($id)
    {
        // 1. db connection
        $con = Database::connect(); // Create db connection
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error handling mode
        $sql = "UPDATE batch_trainee SET sending_mail = 1 WHERE id = :id";
        // 2. prepare statement
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTraineeNum()
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select course.name as cname,count(batch_trainee.trainee_id) as total
        from course join batch_trainee join batch
        where course.id = batch.course_id and batch.id = batch_trainee.batch_id
        group by course.name";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getTraineesByBatchInfo($bid)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select trainee.name as tname,batch_trainee.trainee_id as tid
        from trainee join batch_trainee join batch
        where trainee.id = batch_trainee.trainee_id and batch_trainee.batch_id = :bid group by trainee.name
        ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':bid', $bid);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}
