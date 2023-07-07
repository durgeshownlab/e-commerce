<?php 
session_start();

try
{

    $product_id=$_POST['product_id'];
    include("dbconnect/connection.php");

    $sql="delete from cart where user_id={$_SESSION['user_id']} and product_id={$product_id}";
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