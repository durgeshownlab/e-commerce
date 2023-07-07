<?php
    session_start();
    try
    {
        include("dbconnect/connection.php");
        $output ='';
        $total_ammount=0;

        $output .='
        <div class="cart-container">
            <!-- div for item and its details  -->
            <div class="cart-item-container">';

        $sql="select * from product_table join cart on cart.product_id=product_table.product_id WHERE cart.user_id={$_SESSION['user_id']} and product_table.is_deleted=0 and cart.is_deleted=0;";
        $result=mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                $en_product_id=base64_encode($row['product_id']);
                $total_ammount += $row['total_price'];
                $output .='
                    <div class="cart-item">
                        <!-- code for card item information -->
                        <div class="cart-item-details-container">
                            <div class="cart-item-image-container">
                                <img src="/e-commerce/'.$row['product_image'].'" alt="">
                            </div>
                            <div class="cart-item-details">
                                <div class="name-desc-container">
                                    <a href="/e-commerce/php/productPage.php?product-id='.$en_product_id.'"  class="cart-item-name" target="_blank">
                                        '.ucwords($row['product_name']).'
                                    </a>
                                    <div class="cart-item-desc">
                                        '.$row['product_desc'].'
                                    </div>
                                </div>
                                
                                <div class="cart-item-price">
                                    ₹'.number_format($row['total_price']).'
                                </div>
                            </div>
                        </div>
            
                        <!-- code for operation on card item  -->
                        <div class="cart-operation-container">
                            <div class="quantity-container">
                                <button class="product-quantity-decrease" data-product-id="'.$row['product_id'].'">&minus;</button>
                                <input type="number" name="product-quantity-'.$row['product_id'].'" id="pruduct-quantity-'.$row['product_id'].'" value="'.$row['quantity'].'">
                                <button class="product-quantity-increase" data-product-id="'.$row['product_id'].'">&plus;</button>
                            </div>
                            <div class="remove-from-cart">
                                <button class="remove-from-cart-btn" data-product-id="'.$row['product_id'].'">Remove</button>
                            </div>
                        </div>
                    
                    </div>';
            }
        }
        else
        {
            $output .='<div class="epmty-cart">
                            <img src="/e-commerce/img/empty.png" alt=""></br>
                            <p>Cart is Empty Please Go and Shop</p>
                        </div>
                        ';
        }

            $output .='
                
            </div>
        
            <!-- code for all cart item price and other details  -->
            <div class="cart-price-details-container">
                <div class="price-details-heading">
                    Price Details
                </div>
                <div class="price-details-info-container">
                    <div class="price-info">
                        <div class="product-count">Price ('.mysqli_num_rows($result).' items)</div>
                        <div class="price-ammount">₹'.number_format($total_ammount).'</div>
                    </div>
                    <div class="discount-info">
                        <div class="discount-name">Discount</div>
                        <div class="discount-ammount">&minus; ₹0</div>
                    </div>
        
                    <div class="delivery-info">
                        <div class="delivery-name">Delivery Charges</div>
                        <div class="delivery-ammount">Free</div>
                    </div>
        
                    <div class="total-price-info">
                        <div class="total-price-name">Total Amount</div>
                        <div class="total-ammount">₹'.number_format($total_ammount).'</div>
                    </div>
                </div>
                <div class="place-order-from-cart-container">
                    <button class="place-order-from-cart-btn" id="place-order-from-cart-btn-id"';
        if(mysqli_num_rows($result)<=0)
        {
            $output .='style="display: none;"';
        }
                    
        $output .='>Place Order</button>
                </div>
        
            </div>
        </div>

        ';

        
    }
    catch(Exception $e)
    {
        echo'<script>console.log("'.$e.'");</script>';
    }
    finally{
        mysqli_close($conn);
    }

    echo $output;


?>
