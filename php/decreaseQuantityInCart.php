<?php
session_start();

$product_id=$_POST['product_id'];

include("dbconnect/connection.php");

$sql="select * from cart join product_table on cart.product_id=product_table.product_id where cart.user_id={$_SESSION['user_id']} and cart.product_id={$product_id} and product_table.is_deleted=0 and cart.is_deleted=0";
$result=mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0)
{

    $row=mysqli_fetch_assoc($result);
    if($row['quantity']==1)
    {
        echo 0;
        exit;
    }
    else
    {
        $quantity=$row['quantity']-1;
        $total_price=$row['product_price']*$quantity;
    
        $sql1="update cart set quantity={$quantity}, total_price={$total_price}  where user_id={$_SESSION['user_id']} and product_id={$product_id} and is_deleted=0";
        $result1=mysqli_query($conn, $sql1);
        if($result1)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

}


// echo ($product_name." ".$product_price." ".$product_category." ".$file['name']." ".$destination);

?>