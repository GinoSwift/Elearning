<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Project
{
    public function getProjectLists()
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select ojt_project.id as id,ojt_project.name as pname,batch.name as bname,ojt_project.start_date as sdate,ojt_project.end_date as edate,ojt_project.project_rate as prate
        from ojt_project join batch
        where ojt_project.batch_id = batch.id";
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getProjectInfo($pid)
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select ojt_project.*,batch.name as bname,batch.id as bid from ojt_project join batch where ojt_project.id=:id and ojt_project.batch_id = batch.id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $pid);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createProject($title, $name, $sdate, $edate, $rate)
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "INSERT INTO `ojt_project`(`name`, `batch_id`, `start_date`, `end_date`, `project_rate`) VALUES (:title,:batch,:sdate,:edate,:rate)";
        $statement = $con->prepare($sql);
        try {
            $statement->execute([
                ':title' => $title,
                ':batch' => $name,
                ':sdate' => $sdate,
                ':edate' => $edate,
                ':rate' => $rate
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
