<?php

    try
    {
        include("../dbconnect/connection.php");
        $output ='';

        $sql="select * from orders order by order_date desc";
        $result=mysqli_query($conn, $sql);
        
        $output .='
            <div class="filter-bar-container">
                <div class="filter-bar"></div>
                <div class="filter-button">
                    <i class="fa-solid fa-filter"></i>&nbsp;Filter
                    <div class="filter-list-container">
                        <div class="filter-list">
                            <div class="payment-mode-filter">
                                <p>Payment Mode</p>
                                <div class="filter-item">
                                    <input type="checkbox" name="payment-mode[]" id="pod-filter" value="pod">
                                    <label for="pod-filter">POD</label>
                                </div>

                                <div class="filter-item">
                                    <input type="checkbox" name="payment-mode[]" id="online-filter" value="online">
                                    <label for="online-filter">Online</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';

        $output .='<table class="product-item-container">
                    <tr class="table-heading">
                        <th>
                            <p>Order ID</p>
                        </th>
                        <th>
                            <p>Transaction ID</p>
                        </th>
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>Quantity</p>
                        </th> 
                        <th>
                            <p>Total Price</p>
                        </th>
                        <th>
                            <p>Payment Mode</p>
                        </th>
                        <th>
                            <p>Order Date</p>
                        </th>
                        <th>
                            <p>Operation</p>
                        </th>
                    </tr>';
    
        if(mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result)){
                $sql2="select product_name from product_table where product_id={$row['product_id']}";
                $result2=mysqli_query($conn, $sql2);
                if(mysqli_num_rows($result2)>0)
                {
                    $row2=mysqli_fetch_assoc($result2);
                }
                
                $output .='
                <tr data-order-id="'.$row['order_id'].'"';
                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
        $output .='>
                    <td class="order-id">
                    <p>'.$row['order_id'].'</p>
                    </td>
                    <td class="transaction-id">
                        <p>'.$row['transaction_id'].'</p>
                    </td>
                    <td class="product-name">
                        <p>'.ucwords($row2['product_name']).'</p>
                    </td>
                    <td class="quantity">
                        <p>'.$row['quantity'].'</p>
                    </td>
                    <td class="total-price">
                        <p>&#8377;'.number_format($row['total_price']).'</p>
                    </td>
                    <td class="payment-method">
                        <p>'.ucwords($row['payment_method']).'</p>
                    </td>
                    <td class="order-date">
                        <p>'.$row['order_date'].'</p>
                    </td>
                    <td class="product-operation">
                        <button class="product-view-btn" data-order-id="'.$row['order_id'].'">View</button>
                    </td>
                </tr>';
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
    $output .='</table>
    <div class="reload-order-btn" id="reload-order-btn-id">
        <i class="fa-solid fa-rotate-right"></i>
    </div>
    ';
    echo $output;
?>


