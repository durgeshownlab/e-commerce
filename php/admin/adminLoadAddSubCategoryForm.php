<?php
session_start();
include("../dbconnect/connection.php");

$category_id=$_POST['category_id'];

$output ='';

$sql = "select * from product_category where id={$category_id} and is_deleted=0";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
}

$output .='
<div class="sub-category-form-container">
    <!-- form header  -->
    <div class="form-header">
        <div class="form-title">Add Sub-Category</div>
        <div class="form-close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    <!-- form container which contains  the form  -->
    <form action="/" method="post" class="add-sub-category-form" id="add-sub-category-form-id">

        <div class="form-group">
            <div class="form-category-name">
                <span>Category Name</span>
                <input type="hidden" value="'.$row['id'].'" name="category-id" id="category-id">
                <input type="text" value="'.$row['name'].'" placeholder="Category Name" name="category-name" id="category-name" disabled>
            </div>
            <div class="form-sub-category-name">
                <span>Sub-Category Name</span>
                <input type="text" placeholder="Sub Category Name" name="sub-category-name" id="sub-category-name">
            </div>

        </div>

        <div class="form-group">
            <div class="form-sub-category-submit">
                <input type="submit" value="Save" id="sub-category-submit">
            </div>
        </div>
    </form>
</div>

';

echo $output;

?>