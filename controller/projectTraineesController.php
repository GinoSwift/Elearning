<?php
include_once __DIR__ . '/../model/projectTrainees.php';
class ProjectTraineeController extends ProjectTrainees
{
    public function getProjectTrainees()
    {
        return $this->getProjectTraineesList();
    }

    public function addProjectTrainee($project_id, array $trainee, array $status)
    {
        return $this->createProjectTrainees($project_id, $trainee, $status);

        die(var_dump($project_id, $trainee, $status));
        //die(is_array($trainee, $status));

        // for ($i = 0; $i < sizeof($trainee); $i++) {
        //     //$batch_trainee_id = [];
        //     $batch_trainee_id[$i] = $this->getBatchTraineeInfo($trainee[$i]);
        // }
        // die(var_dump($batch_trainee_id[$i]));

        // for ($i = 0; $i < sizeof($batch_trainee_id); $i++) {
        //     $result = $this->createProjectTrainees($project_id, $batch_trainee_id['id'], $status);
        // }
        // //die(var_dump($result));
        // return $result;
    }
}
