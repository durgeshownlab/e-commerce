<?php
session_start();
include('php/dbconnect/connection.php');

$search_data=$_POST['search_data'];

$output = '
    <div class="search-result-item-container">';

$sql="select product_table.product_id as product_id, product_table.product_name as product_name, product_table.product_image as product_image, sub_category.name as sub_category_name from product_table join sub_category on product_table.sub_category_id=sub_category.sub_category_id where (product_table.product_name like '%{$search_data}%' or product_table.product_desc like '%{$search_data}%') and (product_table.is_deleted=0 and sub_category.is_deleted=0) ";

$result=mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        $output .='
            <a href="/e-commerce/php/productPage.php?product-id='.base64_encode($row['product_id']).'" class="search-result-item">
                <div class="search-result-image">
                    <img src="'.$row['product_image'].'" alt="">
                </div>
                <div class="search-result-product-name">
                    <p>'.$row['product_name'].'</p>
                    <p class="category">in '.$row['sub_category_name'].'</p>
                </div>
            </a>';
    }

}
else
{
    $output .='
        <div class="result-not-found">
            Result Not Found For <b>'.$search_data.'</b>
        </div>';
}

$output .='
    </div>
';


echo $output;
?>