<?php
include_once __DIR__ . '/../model/category.php';
class CategoryController extends Category
{
    public function getCategories()
    {
        return $this->getCategoriesList();
    }

    // public function getCategories1()
    // {
    //     return $this->getCategoriesList();
    // }

    public function addCategory($name, $image)
    {
        if ($image['error'] == 0) {
            $filename = $image['name'];
            $extension = explode('.', $filename);
            $filetype = end($extension);
            $temp_file = $image['tmp_name'];
            $filesize = $image['size'];
            $allowed_types = ['jpg', 'jpeg', 'png', 'svg'];
            if (in_array($filetype, $allowed_types)) {
                if ($filesize <= 2000000) {
                    $timestamp = time();
                    $filename = $filename . $timestamp;
                    move_uploaded_file($temp_file, '../uploads/' . $filename);
                    return $this->createCategory($name, $filename);
                }
            }
        }
    }

    public function getCategory($id)
    {
        return $this->getCategoryInfo($id);
    }

    public function editCategory($id, $name, $image)
    {
        if ($image['error'] == 0) {
            $filename = $image['name'];
            $extension = explode('.', $filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $temp_file = $image['tmp_name'];
            $allowed_types = ['svg', 'png', 'pneg', 'jpg', 'avif', 'webp'];
            if (in_array($filetype, $allowed_types)) {
                if ($filesize <= 2000000) {
                    $timestamp = time();
                    $filename = $timestamp . $filename;
                    move_uploaded_file($temp_file, '../uploads/' . $filename);
                    return $this->updateCategory($id, $name, $filename);
                }
            }
        }
    }

    public function deleteCategory($id)
    {
        return $this->deleteCategoryInfo($id);
    }
}
