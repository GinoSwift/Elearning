<?php
include_once __DIR__ . '/../model/course_instructor.php';
class courseInstructorController extends Course_Instructor
{
    public function getCourseInstructors()
    {
        return $this->getCourse_InstructorsList();
    }

    // public function addCourseInstructor()
    // {

    // }
}
