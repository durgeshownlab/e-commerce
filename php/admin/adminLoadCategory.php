<?php

    try
    {
        include("../dbconnect/connection.php");

        $sql="select * from product_category where is_deleted=0";
        $result=mysqli_query($conn, $sql);
    
        $output='<table class="category-item-container">
                    <tr>
                        <th>
                            <p>Image</p>
                        </th>
                        <th>
                            <p>Category Name</p>
                        </th>
                        <th>
                            <p>Operation</p>
                        </th>
                    </tr>';
    
        if($result && mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result)){
                
                $output .='
                <tr data-category-id="'.$row['id'].'">
                    <td class="category-item-img">
                        <img src="../../'.$row['image'].'" alt="">
                    </td>
                    <td class="category-name">
                        <p>'.$row['name'].'</p>
                    </td>
                    <td class="category-operation">
                        <button class="category-update-btn" data-category-id="'.$row['id'].'">Update</button>
                        <button class="category-delete-btn" data-category-id="'.$row['id'].'">Delete</button>
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

                <div class="add-category-btn" id="add-category-btn-id">
                    <i class="fa-solid fa-plus"></i>
                </div>
    ';
    echo $output;
?>


