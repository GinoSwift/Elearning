<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Batch
{
    public function getBatchesList()
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select batch.id as id,batch.name as name,batch.start_date as start_date,batch.image as image,batch.duration as duration,batch.fee as fee,batch.discount as discount,course.name as course_name
        from batch join course
        where batch.course_id = course.id
        group by batch.name";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createBatch($name, $start_date, $duration, $fee, $discount, $course_name, $fileName)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "INSERT INTO `batch`(`name`, `start_date`, `duration`, `fee`, `discount`, `course_id`, `image`) VALUES (:name,:start_date, :duration, :fee, :discount, :course_id, :image)";
        $statement = $con->prepare($sql);

        try {
            $statement->execute([
                ':name' => $name,
                ':start_date' => $start_date,
                ':duration' => $duration,
                ':fee' => $fee,
                ':discount' => $discount,
                ':course_id' => $course_name,
                ':image' => $fileName
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getBatchInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from batch where id=:id";
        $statement = $con->prepare($sql);

        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateBatch($id, $name, $start_date, $duration, $fee, $discount, $fileName)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "update batch set name=:name,start_date=:start_date,duration=:duration,fee=:fee,discount=:discount,image=:image where id=:id";
        $statement = $con->prepare($sql);

        try {
            $statement->execute([
                ':id' => $id,
                ':name' => $name,
                ':start_date' => $start_date,
                ':duration' => $duration,
                ':fee' => $fee,
                ':discount' => $discount,
                ':image' => $fileName
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // public function updateBatch($id, $name, $start_date, $duration, $fee, $discount, $fileName)
    // {
    //     //1.db connection 
    //     $con = Database::connect();
    //     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     //2.write sql
    //     $sql = "update batch set name=:name,start_date=:start_date,duration=:duration,fee=:fee,discount=:discount,image=:image where id=:id";
    //     $statement = $con->prepare($sql);
    //     $statement->bindParam(':id', $id);
    //     $statement->bindParam(':name', $name);
    //     $statement->bindParam(':start_date', $start_date);
    //     $statement->bindParam(':duration', $duration);
    //     $statement->bindParam(':fee', $fee);
    //     $statement->bindParam(':discount', $discount);
    //     $statement->bindParam(':image', $fileName);
    //     if ($statement->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function deleteBatchInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "delete from batch where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getBatchPerYear()
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select year(start_date) as year,COUNT(id) as total
        from batch
        GROUP by year(start_date)";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}
