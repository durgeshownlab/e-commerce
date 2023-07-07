<?php
session_start();
include("../dbconnect/connection.php");

$category_id=$_POST['category_id'];
$output ='';

$sql="select * from product_category where id={$category_id} and is_deleted=0";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
}

$output .='
<div class="form-container">
    <!-- form header  -->
    <div class="form-header">
        <div class="form-title">Update Category</div>
        <div class="form-close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    <!-- form container which contains  the form  -->
    <form action="/" method="post" class="update-category-form" id="update-category-form-id">
        <div class="form-group">
            <div class="form-category-name">
                <span>Category Name</span>
                <input type="hidden" value="'.$row['id'].'" name="category-id" id="category-id">
                <input type="text" value="'.$row['name'].'" placeholder="category Name" name="category-name" id="category-name" autofocus>
            </div>
            <div class="form-category-image">
                <span>category Image</span>
                <input type="hidden" value="'.$row['image'].'" name="existing-category-image-path" name="existing-category-image-path">
                <input type="file" name="category-image" id="category-image">
                <img src="../../'.$row['image'].'">
            </div>
        </div>

        <div class="form-group">
            <div class="form-category-update">
                <input type="submit" value="Update" id="category-update">
            </div>
        </div>
    </form>
</div>

';

echo $output;

?>
