<?php 
session_start();

try
{

    $category_id=$_POST['category_id'];
    include("../dbconnect/connection.php");


    $sql1="select sub_category_id from sub_category where category_id={$category_id} and is_deleted=0";
    $result1=mysqli_query($conn, $sql1);
    


    $sql="update product_category set is_deleted=1 where id={$category_id} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        
        $sql="update sub_category set is_deleted=1 where category_id={$category_id} and is_deleted=0";
        $result=mysqli_query($conn, $sql);
        if($result)
        {
            if(mysqli_num_rows($result1)>0)
            {
                while($row1=mysqli_fetch_assoc($result1))
                {
                    // $sql2="update product_table set is_deleted=1 where sub_category_id={$row1['']} and is_deleted=0";
                    $sql2="update product_table set is_deleted=1 where sub_category_id={$row1['sub_category_id']} and is_deleted=0";
                    $result2=mysqli_query($conn, $sql2);
                    if(!$result2)
                    {
                        echo 0;
                        exit;
                    }
                }
                echo 1;
                exit;
            }
        }
    }
    else
    {
        echo 0;
        exit;
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