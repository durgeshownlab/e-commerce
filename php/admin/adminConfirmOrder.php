<?php 
session_start();

try
{

    $order_id=$_POST['order_id'];
    include("../dbconnect/connection.php");

    $sql="update orders set order_status='confirm' where order_id='{$order_id}' and is_deleted=0 ";
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