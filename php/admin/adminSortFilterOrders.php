<?php
session_start();
include("../dbconnect/connection.php");

$payment_method=[];
$delivery_status=[];
$sort_by=$_POST['sort_by'];
$order_status=$_POST['order_status'];

if(isset($_POST['from_date']) && isset($_POST['to_date']))
{
    $from_date=$_POST['from_date'];
    $to_date=$_POST['to_date'];
}

$output = '';

if(isset($_POST['payment_method']))
{
    $payment_method = $_POST['payment_method'];
}

if(isset($_POST['delivery_status']))
{
    $delivery_status = $_POST['delivery_status'];
}


if(!empty($payment_method) || !empty($delivery_status) || !empty($sort_by) )
{
    $sql = "SELECT * FROM orders WHERE 1=1 ";

    if(isset($_POST['from_date']) && isset($_POST['to_date']) && !empty($from_date) && !empty($to_date))
    {
        $sql .= " and  (date(order_date) BETWEEN '{$from_date}' AND '{$to_date}' or DATE(order_date) BETWEEN '{$to_date}' AND '{$from_date}') ";
    }

    if(!empty($payment_method))
    {
        $sql .= " and payment_method IN ('" . implode("','", $payment_method) . "') ";
    }
    if(!empty($delivery_status))
    {
        $sql .= " and delivery_status IN ('" . implode("','", $delivery_status) . "') ";
    }

    if($order_status==1)
    {
        $sql .= " and is_canceled=1 ";
    }
    else if($order_status==0)
    {
        $sql .= " and is_canceled=0 ";
    }

    if($sort_by=='default')
    {
        $sql .= " order by order_date desc";
    }
    else if($sort_by=='newest first')
    {
        $sql .= " order by order_date desc";
    }
    else if($sort_by=='oldest first')
    {
        $sql .= " order by order_date asc";
    }
    else if($sort_by=='low to high')
    {
        $sql .= " order by total_price asc";
    }
    else if($sort_by=='high to low')
    {
        $sql .= " order by total_price desc";
    }
    else
    {
        $sql .= " order by order_date desc";
    }
    
        // $sql="select * from orders order by order_date desc";
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
                        style="background-color: #1faf1f; color: #fff;"
                    ';
                }
                else if($row['is_canceled']==1)
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
        else if($row['order_status']=='canceled')
        {
            $output .='style="color: #fff;"';
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
                    style="background-color: #1faf1f; color: #fff;"
                ';
            }
            else if($row['is_canceled']==1)
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
                else if($row['order_status']=='canceled')
                {
                    $output .='style="color: #fff;"';
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