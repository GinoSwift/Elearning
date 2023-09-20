<?php
include_once __DIR__ . '/../model/project.php';
class ProjectController extends Project
{
    public function getProjects()
    {
        return $this->getProjectLists();
    }

    public function getProject($pid)
    {
        return $this->getProjectInfo($pid);
    }

    public function addProject($title, $name, $sdate, $edate, $rate)
    {
        return $this->createProject($title, $name, $sdate, $edate, $rate);
    }
}
