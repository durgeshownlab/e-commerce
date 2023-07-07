<?php
session_start();

$category_id=$_POST['category-id'];
$sub_category_name=$_POST['sub-category-name'];


// inserting value in table
include("../dbconnect/connection.php");

$sql="insert into sub_category (name, category_id) values ('{$sub_category_name}', {$category_id})";

$result=mysqli_query($conn, $sql);

if($result)
{
    echo 1;
}
else
{
    echo 0;
}

// echo ($product_name." ".$product_price." ".$product_category." ".$file['name']." ".$destination);

?>