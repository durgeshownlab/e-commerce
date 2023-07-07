<?php 

session_start();

$category_id=$_POST['category_id'];
$output='';

include("../dbconnect/connection.php");

$sql="select * from sub_category where category_id={$category_id} and is_deleted=0";
$result=mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0)
{
    $output .='
        <option value="">-- select sub category --</option>
    ';
    while($row=mysqli_fetch_assoc($result))
    {
        $output .='
        <option value="'.$row['sub_category_id'].'">'.$row['name'].'</option>
        ';
    }
}
else
{
    $output .='<option value="">-- select sub category --</option>';
}

echo $output;
?>