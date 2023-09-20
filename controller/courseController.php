<?php
include_once __DIR__ .  '/../model/course.php';


class CourseController extends Course
{
    public function getCourses()
    {
        return $this->getCoursesList();
    }

    public function getTotalCourses()
    {
        return $this->getNumCourse();
    }

    public function addCourse($name, $cat, $outline, $image)
    {
        if ($image['error'] == 0) {
            $filename = $image['name'];
            $extension = explode('.', $filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $allowed_types = ['jpg', 'jpeg', 'svg', 'png'];
            $temp_file = $image['tmp_name'];
            if (in_array($filetype, $allowed_types)) {
                if ($filesize <= 2000000) {
                    $timestamp = time();
                    $filename = $timestamp . $filename;
                    move_uploaded_file($temp_file, '../uploads/' . $filename);
                    return $this->createCourse($name, $cat, $outline, $filename);
                }
            }
        }
    }

    public function getCourse($id)
    {
        return $this->getCourseInfo($id);
    }

    // public function getCourse1($id)
    // {
    //     return $this->getCourseInfo1($id);
    // }

    public function editCourse($id, $name, $outline, $image)
    {
        if ($image['error'] == 0) {
            $filename = $image['name'];
            $extension = explode('.', $filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $allowed_types = ['jpg', 'jpeg', 'svg', 'png'];
            $temp_file = $image['tmp_name'];
            if (in_array($filetype, $allowed_types)) {
                if ($filesize <= 2000000) {
                    $timestamp = time();
                    $filename = $timestamp . $filename;
                    move_uploaded_file($temp_file, '../uploads/' . $filename);
                    return $this->updateCourse($id, $name, $outline, $filename);
                }
            }
        }
    }

    public function deleteCourse($id)
    {
        return $this->deleteCourseInfo($id);
    }
}
