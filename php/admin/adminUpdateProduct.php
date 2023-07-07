<?php
session_start();

$product_id=$_POST['product-id'];
$product_name=$_POST['product-name'];
$product_price=$_POST['product-price'];
$product_desc=$_POST['product-desc'];
// $number_of_specification=$_POST['number_of_specification'];



//file handling 
$file = $_FILES['product-image'];

if(isset($_FILES['product-image']) && $_FILES['product-image']['error'] === UPLOAD_ERR_OK)
{
    // echo"<script>console.log(".implode(" ",$file).")</script>";

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
    
    // updating value in table if file is selected
    include("../dbconnect/connection.php");

    $sql="update product_table set product_name='{$product_name}', product_image='img/common/{$new_file_name}', product_price='{$product_price}', product_desc='{$product_desc}' where product_id={$product_id} and is_deleted=0";
    
    $result=mysqli_query($conn, $sql);
    
    if($result)
    {
        $status=true;
        for($i=1; $i<=$_SESSION['number_of_specification']; $i++)
        {

            $sql1 = "update product_specifications_table set name='{$_POST['product-specification-name-'.$i]}', value='{$_POST['product-specification-value-'.$i]}' where specification_id={$_POST['product-specification-id-'.$i]} and product_id={$product_id} and is_deleted=0;";
    
            $result1=mysqli_query($conn, $sql1);
            if(!$result1)
            {
                $status=false;
                break;
            }
        }
    
        if($status)
        {
            $existing_product_image_path=$_POST['existing-product-image-path'];
            if (file_exists('../../'.$existing_product_image_path)) {
                if (unlink('../../'.$existing_product_image_path)) {
                    // File deletion successful
                    // echo 'File deleted successfully.';
                    echo 1;
                } else {
                    // File deletion failed
                    // echo 'Failed to delete the file.';
                }
            } else {
                // File does not exist
                // echo 'File not found.';
            }
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
}
else
{
    // updating value in table if file is selected
    include("../dbconnect/connection.php");
    
    $sql="update product_table set product_name='{$product_name}', product_price='{$product_price}', product_desc='{$product_desc}' where product_id={$product_id} and is_deleted=0";
    
    $result=mysqli_query($conn, $sql);
    
    // $product_id=mysqli_insert_id($conn);
    
    if($result)
    {
        $status=true;
        for($i=1; $i<=$_SESSION['number_of_specification']; $i++)
        {
            $sql1 = "update product_specifications_table set name='{$_POST['product-specification-name-'.$i]}', value='{$_POST['product-specification-value-'.$i]}' where specification_id={$_POST['product-specification-id-'.$i]} and product_id={$product_id} and is_deleted=0;";
    
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

}



// echo ($product_name." ".$product_price." ".$product_category." ".$file['name']." ".$destination);

?>