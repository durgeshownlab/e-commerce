<?php
    session_start();
    include('../dbconnect/connection.php');

    $order_id=$_POST['order_id'];
    $delivery_status=$_POST['delivery_status'];

    $sql="select payment_method from orders where order_id='{$order_id}' and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
    }
    else
    {
        exit;
    }

    if($delivery_status=='delivered' && $row['payment_method']=='pod')
    {
        $sql="update orders set delivery_status='{$delivery_status}', payment_status='success' where order_id='{$order_id}' and is_deleted=0";
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
    else
    {
        $sql="update orders set delivery_status='{$delivery_status}' where order_id='{$order_id}' and is_deleted=0";
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
?>