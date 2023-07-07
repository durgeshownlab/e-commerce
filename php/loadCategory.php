<?php

    try
    {
        include("dbconnect/connection.php");
    
        $sql="select * from product_category where is_deleted=0 order by id";
        $result=mysqli_query($conn, $sql);
    
        $output='';
    
        if($result && mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result)){
                $output .='
                <a class="category-item" data-category-id="'.$row['id'].'">
                    <div class="category-item-img">
                        <img src="'.$row['image'].'" alt="">
                    </div>
                    <p>'.$row['name'].'</p>
                </a>';
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
    echo $output;
?>