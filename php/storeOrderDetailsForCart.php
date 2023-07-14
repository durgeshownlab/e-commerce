<?php
session_start();
include("dbconnect/connection.php");

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$address_id= $_POST['address_id'];
$user_id=$_SESSION['user_id'];

if($_POST['payment_mode']=='online')
{
    $razorpay_payment_id=$_POST['razorpay_payment_id'];
    $razorpay_order_id=$_POST['razorpay_order_id'];

    $total_price=0;

    $sql="select cart.quantity as quantity, cart.total_price as total_price, product_table.product_id as product_id, product_table.product_price as price from cart join product_table on cart.product_id=product_table.product_id where cart.user_id={$_SESSION['user_id']} and cart.is_deleted=0 and product_table.is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0)
    {
        $productDetails=array();
        $i=0; 
        while($row=mysqli_fetch_assoc($result))
        {
            $productDetails[$i]=[
                'product_id'        =>  $row['product_id'],
                'quantity'          =>  $row['quantity'],
                'price_single_unit' =>  $row['price'],
                'total_price'       =>  $row['total_price']
            ];
            $total_price += $row['total_price'];
            $i++;
        }
    }

    $payment_method='online';
    $payment_status='success';
    $delivery_status='order confirmed';
    
    $status=true;
    for($i=0; $i<count($productDetails); $i++)
    {
        $custom_order_id= time().'' . bin2hex(random_bytes(4));

         // code for order  event start from the order placed
        date_default_timezone_set("Asia/kolkata");

         $order_event_data = [
            [
              'event_name' => 'order placed',
              'Date' => date('d-m-Y'),
              'Time' => date('H:i:s')
            ]
        ];
    
        $json_order_event_data = json_encode($order_event_data);

        $sql="INSERT INTO orders (order_id, user_id, product_id, address_id, transaction_id, quantity, price_single_unit, total_price, payment_method, payment_status, delivery_status, order_event) VALUES ('{$custom_order_id}', {$user_id}, {$productDetails[$i]['product_id']}, {$address_id}, '{$razorpay_payment_id}', {$productDetails[$i]['quantity']}, {$productDetails[$i]['price_single_unit']}, {$productDetails[$i]['total_price']}, '{$payment_method}', '{$payment_status}', '{$delivery_status}', '{$json_order_event_data}')";
    
        $result=mysqli_query($conn, $sql);
        if($result)
        {
            $productDetails[$i]['order_id']=$custom_order_id;
            $status=true;
        }
        else
        {
            $status=false;
            echo 0;
            exit;
        }
    }

    if($status)
    {
        $sql="select name, email from user_table where user_id={$user_id} and is_deleted=0";
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)==1) 
        { 
            $row=mysqli_fetch_assoc($result);

            $to=$row['email'];
            $subject="order has been successfully placed";
            $body ="";

            $body .="<div style=\"margin:0px auto; width:100%; background-color:#f3f2f0; padding:0px; padding-top:8px; padding-bottom: 8px;\">
                    <table valign=\"top\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"60%\" align=\"center\" style=\"background-color:#fff; padding: 10px 5px\">
                        <tr><td>Hii, <b style=\"text-transform: capitalize;\">{$row['name']}</b></td></tr>
                        <tr><td>
                            <center style=\"border-bottom: 1px dashed gray;\"> 
                                <img src=\"https://freepngimg.com/save/18343-success-png-image/1200x1200\" style=\"width: 100px; height: auto;\">
                                <h1>Your order has been successfully placed</h1>";
            for($i=0; $i<count($productDetails); $i++)
            {
                $en_product_id=base64_encode($productDetails[$i]['product_id']);
                $sql_for_product="select * from product_table where product_id={$productDetails[$i]['product_id']} and is_deleted=0";
                $result_for_product=mysqli_query($conn, $sql_for_product);

                if(mysqli_num_rows($result_for_product)==1)
                {
                    $row_for_product=mysqli_fetch_assoc($result_for_product);
                }
                $body .="
                        <img src=\"../{$row_for_product['product_image']}\" style=\"width: 150px; height: auto;\"><br/><br/>
                        <a href=\"127.0.0.1/e-commerce/php/productPage.php?product-id={$en_product_id}\" style=\"text-decoration: none; color: blue; font-size: 1.2rem; text-transform: capitalize;\">{$row_for_product['product_name']}</a><br/>
                        Quantity:  {$productDetails[$i]['quantity']}<br/>
                        Price: <b> ₹</b>".number_format($row_for_product['product_price']*$productDetails[$i]['quantity'])."<br/><br/>";
            } 

                $body .= "
                            </center><br/>
                        </td>
                        </tr>

                        <tr>
                            <td><center>Total Price : ₹".number_format($total_price)."</center></td>
                        </tr>
                        <tr>
                            <td><center>Payment ID: {$razorpay_payment_id}</center><br/><br/></td>
                        </tr>
                        <tr><td><center>
                        <a href=\"127.0.0.1/e-commerce/\" style=\"padding: 5px 10px; border: none; background-color: green; border-radius: 5px; text-decoration: none; color: #fff;\">Visit Our Website</a><br/><br/>
                        Thank you for shoping
                        </center>
                        </td>
                        </tr>
                    </table>
                    </div>";

                //Import PHPMailer classes into the global namespace
                //These must be at the top of your script, not inside a function
            
                require 'PHPMailer/Exception.php';
                require 'PHPMailer/PHPMailer.php';
                require 'PHPMailer/SMTP.php';

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings                 //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'hamarfreefire2021@gmail.com';                     //SMTP username
                    $mail->Password   = 'jlatawobrxvhdjgi';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('hamarfreefire2021@gmail.com', 'E-commerce');
                    $mail->addAddress($to, $row['name']);     //Add a recipient


                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $body;

                    $mail->send();
                    // echo "<script>console.log('Email successfully sent to {$to}')</script>";
                } 
                catch (Exception $e){
                    // echo "<script>console.log('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');";
                }
                
            $response=[
                'status'    =>  1,
                'data'      =>  $productDetails
            ];
            echo json_encode($response);
        }
    }
    else
    {
        $response=[
            'status'    =>  0
        ];
        echo json_encode($response);
    }
}
else if($_POST['payment_mode']=='pod')
{

    $total_price=0;

    $sql="select cart.quantity as quantity, cart.total_price as total_price, product_table.product_id as product_id, product_table.product_price as price from cart join product_table on cart.product_id=product_table.product_id where cart.user_id={$_SESSION['user_id']} and cart.is_deleted=0 and product_table.is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0)
    {
        $productDetails=array();
        $i=0; 
        while($row=mysqli_fetch_assoc($result))
        {
            $productDetails[$i]=[
                'product_id'        =>  $row['product_id'],
                'quantity'          =>  $row['quantity'],
                'price_single_unit' =>  $row['price'],
                'total_price'       =>  $row['total_price']
            ];
            $total_price += $row['total_price'];
            $i++;
        }
    }

    $payment_method='pod';
    $payment_status='pending';
    $delivery_status='order confirmed';
    
    $status=true;
    for($i=0; $i<count($productDetails); $i++)
    {
        $custom_order_id = time().'' . bin2hex(random_bytes(4));

         // code for order  event start from the order placed

        date_default_timezone_set("Asia/kolkata");

         $order_event_data = [
            [
              'event_name' => 'order placed',
              'Date' => date('d-m-Y'),
              'Time' => date('H:i:s')
            ]
        ];
    
        $json_order_event_data = json_encode($order_event_data);

        $sql="INSERT INTO orders (order_id, user_id, product_id, address_id, quantity, price_single_unit, total_price, payment_method, payment_status, delivery_status, order_event) VALUES ('{$custom_order_id}', {$user_id}, {$productDetails[$i]['product_id']}, {$address_id}, {$productDetails[$i]['quantity']}, {$productDetails[$i]['price_single_unit']}, {$productDetails[$i]['total_price']}, '{$payment_method}', '{$payment_status}', '{$delivery_status}', '{$json_order_event_data}')";
    
        $result=mysqli_query($conn, $sql);
        if($result)
        {
            $productDetails[$i]['order_id']=$custom_order_id;
            $status=true;
        }
        else
        {
            $status=false;
            echo 0;
            exit;
        }
    }

    if($status)
    {
        $sql="select name, email from user_table where user_id={$user_id} and is_deleted=0";
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)==1) 
        { 
            $row=mysqli_fetch_assoc($result);

            $to=$row['email'];
            $subject="order has been successfully placed";
            $body ="";

            $body .="<div style=\"margin:0px auto; width:100%; background-color:#f3f2f0; padding:0px; padding-top:8px; padding-bottom: 8px;\">
                    <table valign=\"top\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"60%\" align=\"center\" style=\"background-color:#fff; padding: 10px 5px\">
                        <tr><td>Hii, <b style=\"text-transform: capitalize;\">{$row['name']}</b></td></tr>
                        <tr><td>
                            <center style=\"border-bottom: 1px dashed gray;\"> 
                                <img src=\"https://freepngimg.com/save/18343-success-png-image/1200x1200\" style=\"width: 100px; height: auto;\">
                                <h1>Your order has been successfully placed</h1>";
            for($i=0; $i<count($productDetails); $i++)
            {
                $en_product_id=base64_encode($productDetails[$i]['product_id']);
                $sql_for_product="select * from product_table where product_id={$productDetails[$i]['product_id']} and is_deleted=0";
                $result_for_product=mysqli_query($conn, $sql_for_product);

                if(mysqli_num_rows($result_for_product)==1)
                {
                    $row_for_product=mysqli_fetch_assoc($result_for_product);
                }
                $body .="
                        <img src=\"../{$row_for_product['product_image']}\" style=\"width: 150px; height: auto;\"><br/><br/>
                        <a href=\"127.0.0.1/e-commerce/php/productPage.php?product-id={$en_product_id}\" style=\"text-decoration: none; color: blue; font-size: 1.2rem; text-transform: capitalize;\">{$row_for_product['product_name']}</a><br/>
                        Quantity:  {$productDetails[$i]['quantity']}<br/>
                        Price: <b> ₹</b>".number_format($row_for_product['product_price']*$productDetails[$i]['quantity'])."<br/><br/>";
            } 

                $body .= "
                            </center><br/>
                        </td>
                        </tr>

                        <tr>
                            <td><center>Total Price : ₹".number_format($total_price)."</center></td>
                        </tr>
                        <tr>
                            <td><center>Payment Type: Pay On Delivery</center><br/><br/></td>
                        </tr>
                        <tr><td><center>
                        <a href=\"127.0.0.1/e-commerce/\" style=\"padding: 5px 10px; border: none; background-color: green; border-radius: 5px; text-decoration: none; color: #fff;\">Visit Our Website</a><br/><br/>
                        Thank you for shoping
                        </center>
                        </td>
                        </tr>
                    </table>
                    </div>";

                //Import PHPMailer classes into the global namespace
                //These must be at the top of your script, not inside a function
            
                require 'PHPMailer/Exception.php';
                require 'PHPMailer/PHPMailer.php';
                require 'PHPMailer/SMTP.php';

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings                 //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'hamarfreefire2021@gmail.com';          //SMTP username
                    $mail->Password   = 'jlatawobrxvhdjgi';                     //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('hamarfreefire2021@gmail.com', 'E-commerce');
                    $mail->addAddress($to, $row['name']);     //Add a recipient


                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $body;

                    $mail->send();
                    // echo "<script>console.log('Email successfully sent to {$to}')</script>";
                } 
                catch (Exception $e){
                    // echo "<script>console.log('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');";
                }
            $response=[
                'status'    =>  1,
                'data'      =>  $productDetails
            ];
            echo json_encode($response);
        }
    }
    else
    {
        $response=[
                'status'    =>  0
            ];
        echo json_encode($response);
    }
}


?>