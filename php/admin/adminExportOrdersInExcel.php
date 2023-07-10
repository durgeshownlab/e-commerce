<?php
session_start();
include("../dbconnect/connection.php");

$payment_method=[];
$delivery_status=[];
$sort_by=$_POST['sort_by'];

$num_of_pod=0;
$num_of_online=0;

$output = '<table cellpadding=5 border=1 cellspacing=5>';

if(isset($_POST['payment_method']))
{
    $payment_method = $_POST['payment_method'];
}

if(isset($_POST['delivery_status']))
{
    $delivery_status = $_POST['delivery_status'];
}


if(!empty($payment_method) || !empty($delivery_status) || !empty($sort_by))
{
    $sql = "SELECT * FROM orders WHERE 1=1 ";
    if(!empty($payment_method))
    {
        $sql .= " and payment_method IN ('" . implode("','", $payment_method) . "') ";
    }
    if(!empty($delivery_status))
    {
        $sql .= " and delivery_status IN ('" . implode("','", $delivery_status) . "') ";
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

    $output .='
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
                </tr>';

    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_assoc($result)){

            if($row['payment_method']=='pod')
            {
                $num_of_pod++;
            }
            if($row['payment_method']=='online')
            {
                $num_of_online++;
            }

            $sql2="select product_name from product_table where product_id={$row['product_id']}";
            $result2=mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }
            
            $output .='
            <tr data-order-id="'.$row['order_id'].'" style="max-height: 20px;">
                <td class="order-id"';

            if($row['delivery_status']=='delivered')
            {
                $output .='
                    style="background-color: red; color: #fff;"
                ';
            }
                
    $output .='>
                <p>'.'#'.$row['order_id'].'</p>
                </td>
                <td class="transaction-id" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['transaction_id'].'</p>
                </td>
                <td class="product-name" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row2['product_name']).'</p>
                </td>
                <td class="quantity" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['quantity'].'</p>
                </td>
                <td class="total-price" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>&#8377;'.number_format($row['total_price']).'</p>
                </td>
                <td class="payment-method" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row['payment_method']).'</p>
                </td>
                <td class="order-date" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['order_date'].'</p>
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
                </tr>';

    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_assoc($result)){

            if($row['payment_method']=='pod')
            {
                $num_of_pod++;
            }
            if($row['payment_method']=='online')
            {
                $num_of_online++;
            }

            $sql2="select product_name from product_table where product_id={$row['product_id']}";
            $result2=mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }
            
            $output .='
            <tr data-order-id="'.$row['order_id'].'" style="max-height: 20px;">
                <td class="order-id" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                <p>'.'#'.$row['order_id']." ".'</p>
                </td>
                <td class="transaction-id" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['transaction_id'].'</p>
                </td>
                <td class="product-name" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row2['product_name']).'</p>
                </td>
                <td class="quantity" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['quantity'].'</p>
                </td>
                <td class="total-price" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>&#8377;'.number_format($row['total_price']).'</p>
                </td>
                <td class="payment-method" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row['payment_method']).'</p>
                </td>
                <td class="order-date" ';

                if($row['delivery_status']=='delivered')
                {
                    $output .='
                        style="background-color: red; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['order_date'].'</p>
                </td>
            </tr>';
        }
    }
}

$output .='<tr></tr>';
$output .='<tr>
    <td>Total POD</td>
    <td>'.$num_of_pod.'</td>
</tr>';
$output .='<tr>
    <td>Total Online</td>
    <td>'.$num_of_online.'</td>
</tr>';
$output .='<tr>
    <td>Total Orders</td>
    <td>'.$num_of_online+$num_of_pod.'</td>
</tr>';


$output .='</table>';

// $filename="Orders_".time().".xls";
header("Content-Type: application/xls");
// header("Content-Disposition:attechment; filename=$filename");

  
echo $output;
?>