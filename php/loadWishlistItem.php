<?php
    session_start();
    try
    {
        include("dbconnect/connection.php");

        $sql="select * from product_table join wishlists on wishlists.product_id=product_table.product_id WHERE wishlists.user_id={$_SESSION['user_id']} and product_table.is_deleted=0 and wishlists.is_deleted=0;";
        $result=mysqli_query($conn, $sql);
    
        $output='<div class="product-item-container" style="background-color: #fff; justify-content: space-around;">';
    
        if(mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result)){
                $en_product_id=base64_encode($row['product_id']);
                $output .='
                <a href="/e-commerce/php/productPage.php?product-id='.$en_product_id.'" class="product-item" data-product-id="'.$row['product_id'].'" target="_blank">
                    <div class="product-item-img">
                        <img src="/e-commerce/'.$row['product_image'].'" alt="">
                    </div>
                    <div class="product-name">
                        <p>'.$row['product_name'].'</p>
                    </div>
                    <div class="product-price">
                        <p>&#8377; &nbsp;'.number_format($row['product_price']).'</p>
                    </div>
                    <div class="product-desc">
                        <p>'.$row['product_desc'].'</p>
                    </div>
                    <div class="wishlist-delete-icon-container" data-product-id="'.$row['product_id'].'">
                        <i class="fa-solid fa-trash"';
                    
                    if(isset($_SESSION['user_id']))
                    {
                        $sql1="select * from wishlists where user_id={$_SESSION['user_id']} and product_id={$row['product_id']} and is_deleted=0";
                        $result1=mysqli_query($conn, $sql1);

                        if(mysqli_num_rows($result1)>0)
                        {
                            $output .='style="color: rgb(255, 0, 0); text-shadow: 0 0 0px rgb(255 255 255);"';
                        }
                        else
                        {
                            $output .='style="color: #fff;"';
                        }
                    }
            $output .=

                        '></i>
                    </div>
                </a>';
            }
        }
        else
        {
            $output .='<div class="epmty-cart">
                            <img src="/e-commerce/img/empty.png" alt=""></br>
                            <p>Wishlist is Empty Please Go and Make your wishes</p>
                        </div>
                        ';
        }
    }
    catch(Exception $e)
    {
        echo'<script>console.log("'.$e.'");</script>';
    }
    finally{
        mysqli_close($conn);
    }
    $output .='</div>';
    echo $output;
?>