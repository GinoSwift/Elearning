<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Course_Instructor
{
    public function getCourse_InstructorsList()
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "SELECT batch.name as batch_name,instructor.name as instructor_name
        from batch join instructor join course_instructor
        on batch.id = course_instructor.batch_id and instructor.id=course_instructor.instructor_id
        group by batch.name ";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
