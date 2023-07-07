<?php 
session_start();

try
{

    $product_id=$_POST['product_id'];
    include("../dbconnect/connection.php");

    $sql="update product_table set is_deleted=1 where product_id={$product_id} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

}
catch(Exception $e)
{
    echo'<script>console.log("'.$e.'");</script>';
}
finally
{
    mysqli_close($conn);
}

?>