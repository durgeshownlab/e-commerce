<?php
    session_start();

    require("../fpdf/fpdf.php");
    include("../dbconnect/connection.php");

    $order_id=$_POST['order_id'];

    $sql="select * from orders where order_id='{$order_id}' and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
    }
    // Instantiate and use the FPDF class 
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(50, 10, 'E-commerce', 1, 0, 'C');
    $pdf->cell(80);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(60, 8, 'Order ID: '.$row['order_id'], 0, 1, 'L');
    $pdf->cell(130);
    $pdf->Cell(60, 8, 'Payment Method: '.$row['payment_method'], 0, 1, 'L');
    $pdf->cell(130);
    $pdf->Cell(60, 8, 'Date: '.$row['order_date'], 0, 1, 'L');

    $pdf->Line(10, 35, 200, 35);


    // code for geting the address details from address tables
    $sql_for_address="select * from address where address_id={$row['address_id']} and is_deleted=0";
    $result_for_address=mysqli_query($conn, $sql_for_address);
    if(mysqli_num_rows($result_for_address)>0)
    {
        $row_for_address=mysqli_fetch_assoc($result_for_address);
    }

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 10, 'Delivery Address', 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(15, 8, 'Name: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 8, $row_for_address['name'], 0, 1, 'L');

    $pdf->Cell(50, 8, $row_for_address['address'], 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 5, 'Locality: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 5, $row_for_address['locality'], 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(12, 5, 'City: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 5, $row_for_address['city'], 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(15, 5, 'State: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 5, $row_for_address['state'], 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(22, 5, 'Pin Code: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 5, $row_for_address['pin_code'], 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'Phone Number: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 10, $row_for_address['mobile'], 0, 1, 'L');

    $pdf->Line(10,90,200,90);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'Products', 0, 1, 'L');

    $pdf->Cell(120, 10, 'Product Name', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Quantity', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Unit Price', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 12);

    // code for geting the product details from product tables
    $sql_for_product="select * from product_table where product_id={$row['product_id']} and is_deleted=0";
    $result_for_product=mysqli_query($conn, $sql_for_product);
    if(mysqli_num_rows($result_for_product)>0)
    {
        $row_for_product=mysqli_fetch_assoc($result_for_product);
    }

    $pdf->Cell(120, 10, $row_for_product['product_name'], 1, 0, 'L');
    $pdf->Cell(35, 10, $row['quantity'], 1, 0, 'C');
    $pdf->Cell(35, 10, $row['price_single_unit'], 1, 1, 'C');

    $pdf->Cell(120, 10, '', 0, 0, 'L');
    $pdf->Cell(35, 10, 'Subtotal', 0, 0, 'L');
    $pdf->Cell(35, 10, $row['quantity']*$row['price_single_unit'], 0, 1, 'C');

    $pdf->Cell(120, 10, '', 0, 0, 'L');
    $pdf->Cell(35, 10, 'Delivery Charges', 0, 0, 'L');
    $pdf->Cell(35, 10, '0', 0, 1, 'C');

    $pdf->Cell(120, 10, '', 0, 0, 'L');
    $pdf->Cell(35, 10, 'Tax', 0, 0, 'L');
    $pdf->Cell(35, 10, '0', 0, 1, 'C');

    $pdf->Line(130, 150, 200, 150);

    $pdf->Cell(120, 10, '', 0, 0, 'L');
    $pdf->Cell(35, 10, 'Total', 0, 0, 'L');
    $pdf->Cell(35, 10, $row['quantity']*$row['price_single_unit'], 0, 0, 'C');

    $pdf->Line(10, 160, 200, 160);

    $pdf->Output($row['order_id'].".pdf", 'D');
    // ob_end_flush();
    
?>