<?php
session_start();

$product_name=$_POST['product-name'];
$product_price=$_POST['product-price'];
$product_category=$_POST['product-category'];
$product_sub_category=$_POST['product-sub-category'];
$product_desc=$_POST['product-desc'];
$number_of_specification=$_POST['number-of-specification'];

//file handling 
$file = $_FILES['product-image'];

$file_name = $file['name'];
$file_tmp_name = $file['tmp_name'];
$file_error = $file['error'];

if ($file_error === UPLOAD_ERR_OK) 
{
    // Validate file type and size
    $allowed_extensions = array(
        'jpg',
        'jpeg',
        'png',
        'gif',
        'bmp',
        'tiff',
        'tif',
        'webp',
        'svg',
        'ico',
        'psd',
        'eps',
        'ai'
    );
    $max_file_size = 10 * 1024 * 1024; // 10MB

    $file_info = pathinfo($file_name);
    $file_extension = strtolower($file_info['extension']);

    if (!in_array($file_extension, $allowed_extensions)) {
        echo 'Invalid file format';
        exit;
    }

    if ($file['size'] > $max_file_size) {
        echo 'File size exceeds the maximum limit of 10MB.';
        exit;
    }

    // Generate a unique filename
    $new_file_name = uniqid('', true) . '.' . $file_extension;

    // Specify the directory to which the file should be moved
    $upload_directory = '../../img/common/';

    // Move the file to the upload directory
    $destination = $upload_directory . $new_file_name;
    if (move_uploaded_file($file_tmp_name, $destination)) 
    {
        
    } 
    else 
    {
        echo 'Failed to move the uploaded file.';
        exit;
    }
} 
else 
{
    echo 'File upload failed';
    exit;
}

// inserting value in table
include("../dbconnect/connection.php");

$sql="insert into product_table (product_name, product_image, product_price, product_desc, sub_category_id) values ('{$product_name}', 'img/common/{$new_file_name}','{$product_price}','{$product_desc}',{$product_sub_category})";

$result=mysqli_query($conn, $sql);

$product_id=mysqli_insert_id($conn);

if($result)
{
    $status=true;
    for($i=1; $i<=$number_of_specification; $i++)
    {
        // $sql1="insert into product_specifications_value_table (product_id, specification_id, value) values ({$product_id} ,{$_POST['product-specification-'.$i]}, '{$_POST['product-specification-value-'.$i]}')";

        $sql1 = "INSERT INTO product_specifications_table (product_id, name, value) VALUES ({$product_id} ,'{$_POST['product-specification-name-'.$i]}', '{$_POST['product-specification-value-'.$i]}');";

        $result1=mysqli_query($conn, $sql1);
        if(!$result1)
        {
            $status=false;
            break;
        }
    }

    if($status)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}
else
{
    if (file_exists($destination)) {
        if (unlink($destination)) {
            // File deletion successful
            // echo 'File deleted successfully.';
        } else {
            // File deletion failed
            // echo 'Failed to delete the file.';
        }
    } else {
        // File does not exist
        // echo 'File not found.';
    }
    echo 0;
}

// echo ($product_name." ".$product_price." ".$product_category." ".$file['name']." ".$destination);

?>