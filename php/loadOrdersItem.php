<?php 
session_start();
include('dbconnect/connection.php');

$output = '
    <div class="order-item-container">';

$sql="select product_table.product_image as product_image, product_table.product_name as product_name, product_table.product_desc as product_desc, orders.quantity as quantity, orders.total_price as total_price, orders.delivery_status as delivery_status, orders.order_id as order_id from orders join product_table on orders.product_id=product_table.product_id where orders.user_id={$_SESSION['user_id']} order by orders.order_date desc";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0)
{
    $output .='<h3>My Orders</h3>';
    while($row=mysqli_fetch_assoc($result))
    {
        
        $output .='
                <a href="#" class="order-item" data-order-id="'.$row['order_id'].'">
                    <div class="order-image-container">
                        <img src="/e-commerce/'.$row['product_image'].'" alt="">
                    </div>
        
                    <div class="order-product-name-desc">
                        <div class="order-product-name">
                            <p>'.ucwords(substr($row['product_name'], 0, 20)).'...</p>
                        </div>
                        <div class="order-product-desc">
                            <p>'.ucfirst($row['product_desc']).'</p>
                        </div>
                        <div class="order-id">
                            Order Id:&nbsp; <p>'.$row['order_id'].'</p>
                        </div>
                    </div>
        
                    <div class="order-product-quantity-price">
                        <div class="order-product-quantity">
                            <p>Quantity: '.$row['quantity'].'</p>
                        </div>
                        <div class="order-product-price">
                            <p>&#8377;'.number_format($row['total_price']).'</p>
                        </div>
                    </div>
        
                    <div class="order-delivery-status-container">
                        <div class="order-delivery-status">
                        <i class="fa-solid fa-circle"></i>
                        <P>'.ucwords($row['delivery_status']).'</P>
                        </div>
                    </div>
                    
                </a>';
    }
}
else
{
    $output .='
    <div class="epmty-cart">
        <img src="/e-commerce/img/empty.png" alt=""></br>
        <p>You have not ordered any product</p>
    </div>
    ';
}

$output .='
    </div>
';


echo $output;

?>