<?php
session_start();

$sub_category_id=$_POST['sub-category-id'];
$sub_category_name=$_POST['sub-category-name'];

// updating value in table if file is selected
include("../dbconnect/connection.php");

$sql="update sub_category set name='{$sub_category_name}' where sub_category_id={$sub_category_id} and is_deleted=0";

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