<?php
session_start();
include("../dbconnect/connection.php");

$sub_category_id=$_POST['sub_category_id'];

$output ='';

$sql = "select * from sub_category where sub_category_id={$sub_category_id} and is_deleted=0";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
}

$sql1 = "select name from product_category where id={$row['category_id']} and is_deleted=0";
$result1 = mysqli_query($conn, $sql1);

if(mysqli_num_rows($result1)>0)
{
    $row1=mysqli_fetch_assoc($result1);
}

$output .='
<div class="sub-category-form-container">
    <!-- form header  -->
    <div class="form-header">
        <div class="form-title">Update Sub-Category</div>
        <div class="form-close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    <!-- form container which contains  the form  -->
    <form action="/" method="post" class="update-sub-category-form" id="update-sub-category-form-id">

        <div class="form-group">
            <div class="form-category-name">
                <span>Category Name</span>
                <input type="hidden" value="'.$row['category_id'].'" name="category-id" id="category-id">
                <input type="text" value="'.$row1['name'].'" placeholder="Category Name" name="category-name" id="category-name" disabled>
            </div>
            <div class="form-sub-category-name">
                <span>Sub-Category Name</span>
                <input type="hidden" value="'.$sub_category_id.'" placeholder="Sub Category id" name="sub-category-id" id="sub-category-id">
                <input type="text" value="'.$row['name'].'" placeholder="Sub Category Name" name="sub-category-name" id="sub-category-name">
            </div>

        </div>

        <div class="form-group">
            <div class="form-sub-category-update">
                <input type="submit" value="Update" id="sub-category-update">
            </div>
        </div>
    </form>
</div>

';

echo $output;

?>