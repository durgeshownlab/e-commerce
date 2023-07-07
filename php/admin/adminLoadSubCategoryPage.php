<?php

    include("../dbconnect/connection.php");

    $output='';
    $sql="select * from product_category where is_deleted=0";
    $result=mysqli_query($conn, $sql);

    $output .='
        <select name="category-id-of-subcategory-page" id="category-id-of-subcategory-page">
    ';

    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_assoc($result))
        {
            $output .='
                <option value="'.$row['id'].'">'.$row['name'].'</option>
            ';
        }
    }

    $output .='
        </select>
        <div class="sub-category-container">

        </div>
    ';

    echo $output;

?>