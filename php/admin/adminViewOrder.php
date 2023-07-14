<?php
session_start();
include("../dbconnect/connection.php");

$output ='';

$sql = "select * from orders where order_id='{$_POST['order_id']}'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
}

$sql_for_product="select product_name, product_image, product_desc from product_table where product_id={$row['product_id']}";
$result_for_product = mysqli_query($conn, $sql_for_product);
if(mysqli_num_rows($result_for_product)>0)
{
    $row_for_product=mysqli_fetch_assoc($result_for_product);
}

$sql_for_address="select * from address where address_id={$row['address_id']}";
$result_for_address = mysqli_query($conn, $sql_for_address);
if(mysqli_num_rows($result_for_address)>0)
{
    $row_for_address=mysqli_fetch_assoc($result_for_address);
}

$output .='
<div class="category-form-container view-order-form-container">
    <!-- form header  -->
    <div class="form-header">
        <div class="form-title">View Order Details</div>
        <div class="get-invoice-btn" data-order-id="'.$_POST['order_id'].'">Get Invoice</div>
        <div class="admin-operation-container">';

if($row['delivery_status'] !='delivered' && $row['is_canceled'] == 0 && $row['order_status'] == 'pending')
{
    $output .='<button id="cancel-order-admin" data-order-id="'.$row['order_id'].'">Cancel Order</button>';
    $output .='<button id="confirm-order-admin" data-order-id="'.$row['order_id'].'">Confirm Order</button>';
}


$output .='
        </div>
        <div class="form-close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>

    <!-- form container which contains  the form  -->
    <form action="/" method="post" class="add-category-form" id="view-order-details-id">
        <input type="hidden" name="order-id" value="'.$row['order_id'].'">
        <div class="card">
            <div class="card-image-container">
                <img src="../../'.$row_for_product['product_image'].'" alt="">
            </div>

            <div class="card-product-details">
                <div class="product-name-desc-container">
                    <div class="product-name">
                        '.ucwords($row_for_product['product_name']).'
                    </div>
                    <div class="product-desc">
                        '.$row_for_product['product_desc'].'
                    </div>
                </div>

                <div class="product-price-quantity-container">
                    <div class="product-price">
                        &#8377;'.number_format($row['price_single_unit']).'
                    </div>
                    <div class="product-quantity">
                        Quantity: '.$row['quantity'].'
                    </div>
                </div>

                <div class="product-total-price-container">
                    <div class="product-total-price">
                        Total Price: <span>&#8377;'.number_format($row['total_price']).'</span>
                    </div>
                </div>
                
                
            </div>

            <div class="card-payment-details">
                <div class="product-transaction-id">
                    <p>Transaction ID: </p>
                    <span>'.$row['transaction_id'].'</span>
                </div>
                <div class="product-order-id">
                    <p>Order ID: </p>
                    <span>'.$row['order_id'].'</span>
                </div>
                <div class="product-payment-type">
                    <p>Payment Type</p>
                    <span>'.$row['payment_method'].'</span>
                </div>
                <div class="product-payment-status">
                    <p>Payment Status</p>
                    <span>'.$row['payment_status'].'</span>
                </div>
                <div class="product-delivery-status">
                    <p>Delivery Status </p>';
                if($row['is_canceled']==0)
                {
                    if($row['order_status']!='pending')     
                    {
                        if($row['delivery_status']!='delivered')
                        {
                            $output .='<select id="delivery-status">';
        
                            if($row['delivery_status']=='order confirmed')
                            {
                                $output .='
                                    <option value="">'.$row['delivery_status'].'</option>
                                    <option value="shipped">Shipped</option>';
                            }
                            else if($row['delivery_status']=='shipped')
                            {
                                $output .='
                                    <option value="">'.$row['delivery_status'].'</option>
                                    <option value="out for delivery">Out For Delivery</option>';
                            }
                            else if($row['delivery_status']=='out for delivery')
                            {
                                $output .='
                                    <option value="">'.$row['delivery_status'].'</option>
                                    <option value="delivered">Delivered</option>';
                            }
                            $output .='</select> 
                                <button id="update-delivery-status-btn">Update</button>            
                            ';
                        }
                        else
                        {
                            $output .='<p style="color: green;">Delivered</p>';
                        }
                    }
                    else
                    {
                        $output .='<p style="color: #ffa000;">Pending</p>';
                    }
                }
                else
                {
                    $output .='<p style="color: red;">Canceled</p>';
                }
    
    $output .='
                </div>
            </div>

            <div class="card-delivery-address-details">
                <div class="product-delivery-address-title">
                    <p>Delivery Address </p>
                </div>
                <div class="product-order-date">
                    <p>Order Date</p>
                    <span>'.$row['order_date'].'</span>
                </div>
                <div class="product-delivery-person">
                    <p>'.ucwords($row_for_address['name']).'</p>
                    <span>
                        '.$row_for_address['address'].'<br/>
                        <b>Locality:</b> '.$row_for_address['locality'].'</br>
                        <b>City:</b> '.$row_for_address['city'].' <br/>
                        <b>State:</b> '.$row_for_address['state'].' </br>
                        <b>Pin Code:</b> '.$row_for_address['pin_code'].'
                    </span>
                </div>
                <div class="product-delivery-phone-number">
                    <p>Phone Number:</p>
                    <span>'.$row_for_address['mobile'].'</span>
                </div>
            </div>
        </div>

    </form>

    <div class="delivery-status-event-container">
        <div class="delivery-status-event">';
    
    $order_event=json_decode($row['order_event'], true);

    for($i=0; $i<count($order_event); $i++)
    {
        if($order_event[$i]['event_name']!='order canceled')
        {
            $output .='
            <div class="delivery-status-order-confirmed">
                <div class="delivery-status-text">
                    <span>'.$order_event[$i]['event_name'].'</span>
                </div>
                <div class="delivery-status-date-time">
                    <span>'.$order_event[$i]['Date'].' '.$order_event[$i]['Time'].'</span>
                </div>
            </div>';
        }   
        else
        {
            $output .='
            <div class="delivery-status-order-canceled">
                <div class="delivery-status-text">
                    <span>'.$order_event[$i]['event_name'].'</span>
                </div>
                <div class="delivery-status-date-time">
                    <span>'.$order_event[$i]['Date'].' '.$order_event[$i]['Time'].'</span>
                </div>
            </div>';
        }

    }

    $output .='
        </div>
    </div>
</div>

';

echo $output;

?>