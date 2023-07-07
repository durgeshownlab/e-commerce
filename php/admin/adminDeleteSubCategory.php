<?php 
session_start();

try
{

    $sub_category_id=$_POST['sub_category_id'];
    include("../dbconnect/connection.php");

    $sql="update sub_category set is_deleted=1 where sub_category_id={$sub_category_id} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        $sql="update product_table set is_deleted=1 where sub_category_id={$sub_category_id} and is_deleted=0";
        $result=mysqli_query($conn, $sql);
        if($result)
        {
            echo 1;
        }
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