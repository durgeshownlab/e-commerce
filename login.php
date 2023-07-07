<?php 
session_start();

if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='admin' && isset($_SESSION['email']))
{
    header("Location: php/admin/");
}
else if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='customer' && isset($_SESSION['email']) )
{
    header("Location: /");
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login-btn']))
{
    try
    {
        $email=$_POST['email'];
        $password=$_POST['password'];

        include("php/dbconnect/connection.php");

        $sql="select user_id, name, email, mobile, user_type from user_table where email='".$email."' and password='".$password."' and is_deleted=0";
        $result=mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)==1)
        {
            $row=mysqli_fetch_assoc($result);

            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['name']=$row['name'];
            $_SESSION['email']=$row['email'];
            $_SESSION['mobile']=$row['mobile'];
            $_SESSION['user_type']=$row['user_type'];

            if($row['user_type']=='admin')
            {
                header("Location: php/admin/");
            }
            else if($row['user_type']=='customer')
            {
                header("Location: /e-commerce");
            }
            echo("<script> console.log('".$row['name']." ".$row['email']."')</script>");
        }
        else
        {
            echo'<div class="notification">User does not exist<span class="notification-hide-btn"><i class="fa-solid fa-xmark"></i></span></div>';
        }
    }
    catch(Exception $e)
    {
        echo $e;
    }
    finally
    {
        mysqli_close($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | E-commerce</title>
    <link rel="shortcut icon" href="img/facebook-icon.png" type="image/x-icon">

     <!-- font awesome cdn link -->
     <script src="https://kit.fontawesome.com/ca7271c9b6.js" crossorigin="anonymous"></script>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-form-container">
            <div class="form-title">
                <p>Log in</p>
            </div>
            <form action="" method="post" class="form-container">
                <div class="email-container">
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="submit-container">
                    <input type="submit" value="Log in" name="login-btn" id="login-btn">
                </div>
            </form>
            <div class="form-footer">
                <p>
                    Don't have an account?&nbsp;
                    <a href="#">Sign Up</a> 
                </p>
                <a href="#">Forgot Password</a>
            </div>
        </div>
    </div>

    <!-- javascript from here  -->
    <!-- jquery ui  -->
    <script src="javascript/jquery-ui.min.js"></script>
    <!-- jquery ajax -->
    <script src="javascript/jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            
            $(document).on("click", ".notification-hide-btn", (e)=>{
                // e.preventDefault();
                $(".notification").slideUp();
            })

        });

    </script>
</body>
</html>