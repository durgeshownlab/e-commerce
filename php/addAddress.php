<?php
    session_start();
    include("dbconnect/connection.php");

    $customer_name=$_POST['customer-name'];
    $customer_mobile_number=$_POST['customer-mobile-number'];
    $customer_pincode=$_POST['customer-pincode'];
    $customer_locality=$_POST['customer-locality'];
    $customer_full_address=$_POST['customer-full-address'];
    $customer_city=$_POST['customer-city'];
    $customer_state=$_POST['customer-state'];
    $customer_address_type=$_POST['customer-address-type'];
    
    if(empty($customer_name))
    {
        echo("Please enter name");
        exit;
    }
    else if(preg_match('/\d/', $customer_name))
    {
        echo("Name should not contain number");
        exit;
    }
    else if(empty($customer_mobile_number))
    {
        echo "Please enter mobile number";
        exit;
    }
    else if(!preg_match('/^\d{10}$/', $customer_mobile_number))
    {
        echo "Please enter a valid mobile number";
        exit;
    }
    else if(empty($customer_pincode))
    {
        echo "Please enter pin code";
        exit;
    }
    else if(!preg_match('/^\d{6}$/', $customer_pincode))
    {
        echo "Please enter a valid pin code";
        exit;
    }
    else if(empty($customer_locality))
    {
        echo "Please enter locality";
        exit;
    }
    else if(empty($customer_full_address))
    {
        echo "Please enter address";
        exit;
    }
    else if(empty($customer_city))
    {
        echo "Please enter city";
        exit;
    }
    else if(empty($customer_state))
    {
        echo "Please enter state";
        exit;
    }
    else if(empty($customer_address_type))
    {
        echo "Please enter address type ";
        exit;
    }
    else
    {
        $sql="INSERT INTO address (user_id, name, mobile, pin_code, locality, address, city, state, address_type) VALUES ({$_SESSION['user_id']}, '{$customer_name}', '{$customer_mobile_number}', '{$customer_pincode}','{$customer_locality}', '{$customer_full_address}', '{$customer_city}','{$customer_state}', '{$customer_address_type}')";

        $result=mysqli_query($conn, $sql);
        if($result)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

        // echo($customer_name.' '.$customer_mobile_number.' '.$customer_pincode.' '.$customer_locality.' '.$customer_full_address.' '.$customer_city.' '.$customer_state);
    }

?>