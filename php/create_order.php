<?php
session_start();
include("dbconnect/connection.php");
// Include the Razorpay PHP SDK
// require('razorpay-php/Razorpay.php');
require('../gateway-config.php');
require('../razorpay-php/Razorpay.php');

use Razorpay\Api\Api;

// Initialize Razorpay API

$api = new Api($keyId, $keySecret);

// Get the payment form data sent via AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Create the order

$sql="select * from product_table join cart on cart.product_id=product_table.product_id where cart.product_id={$data['productId']} and cart.user_id={$_SESSION['user_id']} and product_table.is_deleted=0 and cart.is_deleted=0";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
}
else
{
    
}

$custom_order_id= time().'' . bin2hex(random_bytes(4));

$orderData = [
  'amount'      => (int)($row['product_price']*$row['quantity']) * 100,
  'currency'    => 'INR',
  'receipt'     => 'order_' . uniqid(), // Replace with your own unique identifier for the order
//   'receipt'     => time() . '' . bin2hex(random_bytes(4)), // Replace with your own unique identifier for the order
  'payment_capture' => 1,
  'notes' => [
    'customer_name' => $data['name'],
    'customer_email' => $data['email'],
    // Add any additional notes as needed
    // ...
  ]
];

try {
  // Create the Razorpay order
  $order = $api->order->create($orderData);

  // Get the order ID
  $orderId = $order['id'];
  $amount = $order['amount'];
  $currency = $order['currency'];

  // Return the order ID as the response
  $response = [
    'order_id'          => $orderId,
    'amount'            => $amount,
    'currency'          => $currency,
    'custom_order_id'    => $custom_order_id
  ];

  header('Content-Type: application/json');
  echo json_encode($response);
} catch (Exception $e) {
  // Error handling
  $response = [
    'error' => $e->getMessage()
  ];

  header('HTTP/1.1 500 Internal Server Error');
  header('Content-Type: application/json');
  echo json_encode($response);
}

?>