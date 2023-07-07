<?php
session_start();
include("../dbconnect/connection.php");

$output ='';

$sql = "select * from product_category where is_deleted=0";
$result = mysqli_query($conn, $sql);

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
    <form action="/" method="post" class="add-product-form" id="add-product-form-id">
        <div class="form-group">
            <div class="form-product-name">
                <span>Product Name</span>
                <input type="text" placeholder="Product Name" name="product-name" id="product-name" autofocus>
            </div>
            <div class="form-product-price">
                <span>Product Price</span>
                <input type="text" placeholder="Product Price" name="product-price" id="product-price">
            </div>
        </div>

        <div class="form-group">
            <div class="form-product-image">
                <span>Product Image</span>
                <input type="file" name="product-image" id="product-image">
            </div>
            <div class="form-product-category">
                <span>Product Category</span>
                <select name="product-category" id="product-category">
                    <option value="">-- select category --</option>
';

            while($row=mysqli_fetch_assoc($result))
            {
                $output .='
                    <option value="'.$row['id'].'">'.$row['name'].'</option>
                ';
            }

$output .='

                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="form-product-sub-category">
                <span>Product Sub Category</span>
                <select name="product-sub-category" id="product-sub-category">

                </select>
            </div>
        </div>

<div class="form-group">
    <div class="form-product-desc">
        <span>Product Description</span>
        <textarea placeholder="Enter Product Desccription" name="product-desc" id="product-desc" cols="30" rows="10"></textarea>
    </div>
</div>

<div class="form-product-specifications-container">
    <input type="hidden" id="number-of-specification" name="number-of-specification" value="0">
    <span>Product Specification</span>

    <!-- <div class="form-group">
        <div class="form-product-specification-name">
            <input type="text" placeholder="Name" name="product-specification-name" id="product-specification-name">
        </div>
        <div class="form-product-specification-value">
            <input type="text" placeholder="Value" name="product-specification-value" id="product-specification-value">
        </div>
    </div> -->

</div>

<div class="form-group">
<div class="form-product-submit">
    <button class="add-specification-field-btn">Add Specification</button>
    <input type="submit" value="Save" id="product-submit">
</div>
</div>
</form>
</div>

';

echo $output;

?>