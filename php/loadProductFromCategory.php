<?php

    try
    {
        session_start();
        include("dbconnect/connection.php");

        $category_id=$_POST['category_id'];

        // $sql="select * from product_table where category_id={$category_id}";


        $sql = "SELECT product_table.product_id as product_id, product_table.product_name as product_name, product_table.product_image as product_image, product_table.product_desc as product_desc, product_table.product_price as product_price from product_table JOIN sub_category on product_table.sub_category_id=sub_category.sub_category_id JOIN product_category on sub_category.category_id = product_category.id where product_category.id={$category_id} and product_table.is_deleted=0 and sub_category.is_deleted=0 and product_category.is_deleted=0;";


        $result=mysqli_query($conn, $sql);
    
        $output='<div class="product-item-container">';
    
        if($result && mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result)){
                $en_product_id=base64_encode($row['product_id']);
                $output .='
                <a href="'.basename(__FILE__).'/../php/productPage.php?product-id='.$en_product_id.'" class="product-item" data-product-id="'.$row['product_id'].'" target="_blank">
                    <div class="product-item-img">
                        <img src="'.$row['product_image'].'" alt="">
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

                    <div class="wishlist-icon-container" data-product-id="'.$row['product_id'].'">
                        <i class="fa-solid fa-heart"';

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