<?php
include_once __DIR__ . '/../vendor/db/db.php';

class ProjectTrainees
{
    public function getProjectTraineesList()
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql 
        $sql = "select ojt_project.name as pname,trainee.name as tname,project_trainee.status as status
        from project_trainee join ojt_project join trainee join batch_trainee
        where ojt_project.id = project_trainee.project_id and trainee.id = batch_trainee.trainee_id
        group by ojt_project.name";
        $statement = $con->prepare($sql);

        //3. sql execute
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createProjectTrainees($project_id, $trainee, $status)
    {
        //die(var_dump($project_id, $tid, $status));
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql

        for ($i = 0; $i < count($trainee); $i++) {
            $sql = "insert into project_trainee(project_id,batch_trainee_id,status) values (:pid,:tid,:status)";
            $statement = $con->prepare($sql);
            $statement->bindParam(':pid', $project_id);
            $statement->bindParam(':tid', $trainee[$i]);
            $statement->bindParam(':status', $status[$i]);
        }

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
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
}
