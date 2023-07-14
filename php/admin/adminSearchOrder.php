<?php
session_start();
include("../dbconnect/connection.php");

$search_data=$_POST['search_data'];

$output = '';

if(!empty($search_data))
{
    $sql = "SELECT * FROM orders where order_id like '%{$search_data}%' or transaction_id like '%{$search_data}%' ";
      
    $result=mysqli_query($conn, $sql);

    $output .='<tr class="table-heading">
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
                <td class="quantity">
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
                    
    $output .='>'.$row['order_status'].'</p>
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
else
{
    $sql="select * from orders order by order_date desc";
    $result=mysqli_query($conn, $sql);

    $output .='<tr class="table-heading">
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
                <td class="quantity">
                    <p ';

        if($row['order_status']=='pending')
        {
            $output .='style="color: #ffa000;"';
        }
        else if($row['delivery_status']=='delivered')
        {
            $output .='style="color: #fff;"';
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
                    
    $output .='>';
        
    if($row['delivery_status']=='delivered')
    {
        $output .=''.ucwords($row['delivery_status']).'';
    }
    else
    {
        $output .= ''.ucwords($row['order_status']).'';
    }
    
    $output .='</p>
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
  
echo $output;
?>