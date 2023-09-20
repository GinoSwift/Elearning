<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Course
{
    public function getCoursesList()
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        // $sql = "select course.name as courseName,category.name as categoryName
        // from course join category
        // where course.cat_id = category.id
        // ";
        $sql = "select course.name as name,category.name as catname,course.outline as outline,course.id as id,category.id as catid,course.image as image from course join category on course.cat_id = category.id";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getNumCourse()
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select category.name as cname,count(course.id) as total from course join category on course.cat_id = category.id group by course.cat_id";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createCourse($name, $cat, $outline, $filename)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "insert into course(name,cat_id,outline,image) values (:name,:cat,:outline,:image)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':cat', $cat);
        $statement->bindParam(':outline', $outline);
        $statement->bindParam(':image', $filename);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCourseInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from course where id=:id ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    // public function getCourseInfo1($id)
    // {
    //     //1.db connection 
    //     $con = Database::connect();
    //     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     //2.write sql
    //     $sql = "select batch.name as name,batch.start_date as start_date,batch.duration as duration,batch.fee as fee,batch.discount as discount,batch.id as id1,course.name as coursename,batch.course_id as id
    //     from batch join course
    //     where batch.course_id = course.id
    //     and course.id=:id";
    //     $statement = $con->prepare($sql);
    //     $statement->bindParam(':id', $id);
    //     if ($statement->execute()) {
    //         $result = $statement->fetch(PDO::FETCH_ASSOC);
    //         return $result;
    //     }
    // }

    public function updateCourse($id, $name, $outline, $filename)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "update course set name=:name,outline=:outline,image=:image where id=:id";
        $statement = $con->prepare($sql);
        try {
            $statement->execute([
                ':id' => $id,
                ':name' => $name,
                ':outline' => $outline,
                ':image' => $filename
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteCourseInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "delete from course where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
