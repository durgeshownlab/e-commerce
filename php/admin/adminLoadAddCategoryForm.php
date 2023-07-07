<?php
session_start();
include("../dbconnect/connection.php");

$output ='';

$sql = "select * from product_category where is_deleted=0";
$result = mysqli_query($conn, $sql);

$output .='
<div class="category-form-container">
    <!-- form header  -->
    <div class="form-header">
        <div class="form-title">Add Category</div>
        <div class="form-close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    <!-- form container which contains  the form  -->
    <form action="/" method="post" class="add-category-form" id="add-category-form-id">

        <div class="form-group">
            <div class="form-category-name">
                <span>Product Name</span>
                <input type="text" placeholder="Category Name" name="category-name" id="category-name">
            </div>
            <div class="form-category-image">
                <span>Category Image</span>
                <input type="file" name="category-image" id="category-image">
            </div>

        </div>

        <div class="form-group">
            <div class="form-category-submit">
                <input type="submit" value="Save" id="category-submit">
            </div>
        </div>
    </form>
</div>

';

echo $output;

?>