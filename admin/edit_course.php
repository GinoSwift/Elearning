<?php
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../controller/categoryController.php';
include_once __DIR__ . '/../controller/courseController.php';

$id = $_GET['id'];
// $catid = $_GET['catid'];
$course_controller = new CourseController();
$course = $course_controller->getCourse($id);

$cat_controller = new CategoryController();
$categories = $cat_controller->getCategories();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $cat = $_POST['category'];
    $outline = $_POST['outline'];
    $image = $_FILES['image'];
    // die(var_dump($image));
    $status = $course_controller->editCourse($id, $name, $outline, $image);
    if ($status) {
        $message = 2;
        echo '<script> location.href="course.php?status=' . $message . '"</script>';
    }
}

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong> Update New Course</strong> Dashboard</h1>


        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="" class="form-label">Course Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $course['name'] ?>">
                    </div>

                    <div>
                        <label for="" class="form-label">Course Category</label>
                        <select name="category" id="" class="form-select">

                            <?php
                            foreach ($categories as $category) {
                                if ($category['id'] == $course['cat_id']) {
                                    echo "<option value=" . $category['id'] . " selected>" . $category['name'] . "</option>";
                                } else {
                                    echo "<option value=" . $category['id'] . ">" . $category['name'] . "</option>";
                                }
                            }
                            ?>

                        </select>
                    </div>

                    <div>
                        <label for="" class="form-label">Course Outline</label>
                        <textarea name="outline" id="" cols="30" rows="10" class="form-control" value=""><?php echo $course['outline'] ?></textarea>
                    </div>

                    <div>
                        <label for="" class="form-label">Course Featured Image</label>
                        <div class="my-3">
                            <img src="../uploads/<?php echo $course['image']; ?>" class="image-fluid" width="100px" height="100px" alt="image">
                        </div>
                        <input type="file" name="image" id="" class="form-control">
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-dark" name="submit">UPDATE</button>
                    </div>
                </form>

            </div>
        </div>





    </div>
</main>

<?php
include_once __DIR__ . '/../layouts/app_footer.php';
?>