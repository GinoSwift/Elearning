<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Instructor
{
    public function getInstructorsList()
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from instructor";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createInstructor($name, $email, $phone, $address, $filename)
    {
        echo $email;
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "insert into instructor(name,email,phone,address,image) values (:name,:email,:phone,:address,:image)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':image', $filename);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getInstructorInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from instructor where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateInstructor($id, $name, $email, $phone, $address, $filename)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE instructor SET name=:name,email=:email,phone=:phone,address=:address,image=:image WHERE id=:id";
        $statement = $con->prepare($sql);
        try {
            $statement->execute([
                ':id' => $id,
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':address' => $address,
                ':image' => $filename
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteInstructorInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql
        $sql = "delete from instructor where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    // public function updateInstructor($id, $name, $email, $phone, $address)
    // {
    // //1.db connection
    // $con = Database::connect();
    // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //     //2.write sql
    //     $sql = "UPDATE `instructor` SET `name`=':name',`email`=':email',`phone`=':phone',`address`=':address' WHERE id=:id";
    //     $statement = $con->prepare($sql);
    //     $statement->bindParam(':id', $id);
    //     $statement->bindParam(':name', $name);
    //     $statement->bindParam(':email', $email);
    //     $statement->bindParam(':phone', $phone);
    //     $statement->bindParam(':address', $address);
    //     if ($statement->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function getMail($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from instructor where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['email'];
        }
    }
}
