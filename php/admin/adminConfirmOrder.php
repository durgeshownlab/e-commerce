<?php 
session_start();

try
{

    $order_id=$_POST['order_id'];
    include("../dbconnect/connection.php");

    $order_event_data = [
        [
          'event_name' => 'order placed',
          'Date' => date('d-m-Y'),
          'Time' => date('H:i:s')
        ]
    ];

    $json_order_event_data = json_encode($order_event_data);
      

    $sql="update orders set order_status='confirm', order_event='$json_order_event_data' where order_id='{$order_id}' and is_deleted=0 ";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

}
catch(Exception $e)
{
    echo'<script>console.log("'.$e.'");</script>';
}
finally
{
    mysqli_close($conn);
}

?>