<?php
    session_start();
    include("dbconnect/connection.php");
    if(!isset($_SESSION['user_id']))
    {
        exit;
    }
    else
    {
        $sql="select * from wishlists, product_table where wishlists.user_id={$_SESSION['user_id']} and wishlists.product_id=product_table.product_id and wishlists.is_deleted=0 and product_table.is_deleted=0";
        $result=mysqli_query($conn, $sql);
        
        echo (mysqli_num_rows($result));
    }

?>