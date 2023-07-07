<?php 

session_start();

$product_id=$_POST['product_id'];
$output='';

include("../dbconnect/connection.php");

$sql="select * from product_specifications_table where product_id={$product_id} and is_deleted=0";

$result=mysqli_query($conn, $sql);

$_SESSION['number_of_specification']=mysqli_num_rows($result);

// $number_of_specification=mysqli_num_rows($result);


$count=1;

if(mysqli_num_rows($result)>0)
{
    $output .='<span>Product Specifications</span>';
    
    while($row=mysqli_fetch_assoc($result))
    {
        $output .='
        <div class="form-group">
            <div class="form-product-specification-name">
                <input type="hidden" value="'.$row['specification_id'].'" name="product-specification-id-'.$count.'" id="product-specification-id-'.$count.'">
                <input type="text" value="'.$row['name'].'" name="product-specification-name-'.$count.'" id="product-specification-name-'.$count.'">
            </div>

            <div class="form-product-specification-value">
                <input type="text" value="'.$row['value'].'" placeholder="Value" name="product-specification-value-'.$count.'" id="product-specification-value-'.$count.'">
            </div>
        </div>';
    
        $count++;
    }
}

echo $output;
?>