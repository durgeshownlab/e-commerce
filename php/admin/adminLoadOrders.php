<?php

    try
    {
        include("../dbconnect/connection.php");
        $output ='';

        $sql="select * from orders order by order_date desc";
        $result=mysqli_query($conn, $sql);
        
        $output .='
            <div class="sort-filter-bar-container">
                <div class="filter-button">
                    <i class="fa-solid fa-sliders"></i>&nbsp;Filter
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

                            <div class="delivery-status-filter">
                                <p>Delivery Status</p>
                                <div class="filter-item">
                                    <input type="checkbox" name="delivery-status[]" id="order-confirmed-filter" value="order confirmed">
                                    <label for="order-confirmed-filter">Order Confirmed</label>
                                </div>
                                <div class="filter-item">
                                    <input type="checkbox" name="delivery-status[]" id="shipped-filter" value="shipped">
                                    <label for="shipped-filter">Shipped</label>
                                </div>
                                <div class="filter-item">
                                    <input type="checkbox" name="delivery-status[]" id="out-for-delivery-filter" value="out for delivery">
                                    <label for="out-for-delivery-filter">Out For Delivery</label>
                                </div>
                                <div class="filter-item">
                                    <input type="checkbox" name="delivery-status[]" id="delivered-filter" value="delivered">
                                    <label for="delivered-filter">Delivered</label>
                                </div>
                            </div>

                            <div class="order-status-filter">
                                <p>Order Status</p>
                                <div class="filter-item">
                                    <input type="checkbox" name="order-status" id="order-status-filter" value="1">
                                    <label for="order-status-filter">Canceled</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sort-button">
                    <i class="fa-solid fa-sort"></i>&nbsp;Sort
                    <div class="sort-list-container">
                        <div class="sort-list">
                            <p>Sort By</p>

                            <div class="sort-item">
                                <input type="radio" name="sort-by" id="default-sort" value="default" checked>
                                <label for="default-sort">Default</label>
                            </div>

                            <div class="sort-item">
                                <input type="radio" name="sort-by" id="newest-first-sort" value="newest first" >
                                <label for="newest-first-sort">Newest First</label>
                            </div>

                            <div class="sort-item">
                                <input type="radio" name="sort-by" id="oldest-first-sort" value="oldest first">
                                <label for="oldest-first-sort">Oldest First</label>
                            </div>

                            <div class="sort-item">
                                <input type="radio" name="sort-by" id="low-to-high-sort" value="low to high">
                                <label for="low-to-high-sort">Price - Low to High</label>
                            </div>

                            <div class="sort-item">
                                <input type="radio" name="sort-by" id="high-to-low-sort" value="high to low">
                                <label for="high-to-low-sort">Price - High to Low</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="export-button">
                    <i class="fa-solid fa-file-arrow-down"></i>&nbsp; Export
                </div>

                <div class="date-range">
                    <label for="from">From</label>
                    <input type="date" id="from" name="from">
                    <label for="to">to</label>
                    <input type="date" id="to" name="to">
                    <input type="button" value="Get" id="get-by-date-range">
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
                            <p>Order Status</p>
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
                    <td class="product-name">
                        <p ';

        if($row['order_status']=='pending')
        {
            $output .='style="color: #ffa000;"';
        }
        else if($row['order_status']=='confirm')
        {
            $output .='style="color: green;"';
        }
        else if($row['order_status']=='canceled')
        {
            $output .='style="color: red;"';
        }
        else
        {
            $output .='style="color: #000;"';
        }        
        $output .='>'.ucwords($row['order_status']).'</p>
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


