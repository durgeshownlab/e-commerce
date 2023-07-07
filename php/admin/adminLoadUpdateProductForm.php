<?php
session_start();
include("../dbconnect/connection.php");

$product_id=$_POST['product_id'];
$output ='';

$sql="select * from product_table where product_id={$product_id} and is_deleted=0";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
}

$output .='
<div class="form-container">
    <!-- form header  -->
    <div class="form-header">
        <div class="form-title">Add Product</div>
        <div class="form-close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    <!-- form container which contains  the form  -->
    <form action="/" method="post" class="update-product-form" id="update-product-form-id">
        <div class="form-group">
            <div class="form-product-name">
                <span>Product Name</span>
                <input type="hidden" value="'.$row['product_id'].'" placeholder="Product Name" name="product-id" id="product-id" autofocus>
                <input type="text" value="'.$row['product_name'].'" placeholder="Product Name" name="product-name" id="product-name" autofocus>
            </div>
            <div class="form-product-price">
                <span>Product Price</span>
                <input type="text" value="'.$row['product_price'].'" placeholder="Product Price" name="product-price" id="product-price">
            </div>
        </div>

        <div class="form-group">
            <div class="form-product-image">
                <span>Product Image</span>
                <input type="hidden" value="'.$row['product_image'].'" name="existing-product-image-path" name="existing-product-image-path">
                <input type="file" name="product-image" id="product-image">
            </div>
            <div class="form-product-image">
                <img src="../../'.$row['product_image'].'">
            </div>
        </div>

        <div class="form-group">
            <div class="form-product-category">
                <span>Product Category</span>
';


// $sql1="select * from product_category where id={$row['sub_category_id']}";

$sql1 = "select sub_category.name as sub_category_name, product_category.name as category_name from sub_category join product_category on sub_category.category_id=product_category.id join product_table on sub_category.sub_category_id=product_table.sub_category_id WHERE product_table.product_id={$product_id} and sub_category.is_deleted=0 and product_category.is_deleted=0 and product_table.is_deleted=0;";

$result1 = mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);

$output .='
                <input type="text" value="'.$row1['category_name'].'" name="product-category" id="product-category" disabled>
            </div>

            <div class="form-product-name">
                <span>Product Sub Category</span>
                <input type="text" value="'.$row1['sub_category_name'].'" name="product-sub-category" id="product-sub-category" disabled>
            </div>
        </div>

<div class="form-group">
    <div class="form-product-desc">
        <span>Product Description</span>
        <textarea placeholder="Enter Product Desccription" name="product-desc" id="product-desc" cols="30" rows="10">'.$row['product_desc'].'</textarea>
    </div>
</div>

<div class="form-product-specifications-container">
    

</div>

<div class="form-group">
    <div class="form-product-submit">
        <input type="submit" value="Update" id="product-update">
    </div>
</div>
</form>
</div>

';

echo $output;

?>
