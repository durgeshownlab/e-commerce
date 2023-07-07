<?php 
    try
    {
        include("../dbconnect/connection.php");

        $sql="select * from product_table where is_deleted=0";
        $result=mysqli_query($conn, $sql);
    
        $output='<table class="product-item-container">
                    <tr>
                        <th>
                            <p>Image</p>
                        </th>
                        <th>
                            <p>Product Name</p>
                        </th>
                        <th>
                            <p>Price</p>
                        </th>
                        <th>
                            <p>Desc</p>
                        </th>
                        <th>
                            <p>Operation</p>
                        </th>
                    </tr>';
    
        if($result && mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result)){
                
                $output .='
                <tr data-product-id="'.$row['product_id'].'">
                    <td class="product-item-img">
                        <img src="../../'.$row['product_image'].'" alt="">
                    </td>
                    <td class="product-name">
                        <p>'.$row['product_name'].'</p>
                    </td>
                    <td class="product-price">
                        <p>&#8377; &nbsp;'.$row['product_price'].'</p>
                    </td>
                    <td class="product-desc">
                        <p>'.$row['product_desc'].'</p>
                    </td>
                    <td class="product-operation">
                        <button class="product-update-btn" data-product-id="'.$row['product_id'].'">Update</button>
                        <button class="product-delete-btn" data-product-id="'.$row['product_id'].'">Delete</button>
                    </td>
                </tr>';
            }
        }
    }
    catch(Exception $e)
    {
        echo'<script>console.log("'.$e.'");</script>';
    }
    finally{
        mysqli_close($conn);
    }
    $output .='</table>

                <div class="add-product-btn" id="add-product-btn-id">
                    <i class="fa-solid fa-plus"></i>
                </div>
    ';
    echo $output;
?>


