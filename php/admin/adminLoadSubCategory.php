<?php

    try
    {
        include("../dbconnect/connection.php");

        $category_id=$_POST['category_id'];

        $sql="select * from sub_category where category_id={$category_id} and is_deleted=0";
        $result=mysqli_query($conn, $sql);
    
        $output='<table class="sub-category-item-container">
                    <tr>
                        <th>
                            <p>Sub-Category Name</p>
                        </th>
                        <th>
                            <p>Operation</p>
                        </th>
                    </tr>';
    
        if($result && mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result)){
                
                $output .='
                <tr data-sub-category-id="'.$row['sub_category_id'].'">
                    <td class="sub-category-name">
                        <p>'.$row['name'].'</p>
                    </td>
                    <td class="sub-category-operation">
                        <button class="sub-category-update-btn" data-sub-category-id="'.$row['sub_category_id'].'">Update</button>
                        <button class="sub-category-delete-btn" data-sub-category-id="'.$row['sub_category_id'].'">Delete</button>
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

                <div class="add-sub-category-btn" id="add-sub-category-btn-id" data-category-id="'.$category_id.'">
                    <i class="fa-solid fa-plus"></i>
                </div>
    ';
    echo $output;
?>


