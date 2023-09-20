<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Category
{
    public function getCategoriesList()
    {
        //1.db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from category";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }


    public function createCategory($name, $filename)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "insert into category(name,image) values (:name,:image)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':image', $filename);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategoryInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from category where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateCategory($id, $name, $filename)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "update category set name=:name,image=:image where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':image', $filename);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCategoryInfo($id)
    {
        //1.db connection 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "delete from category where id=:id";
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
