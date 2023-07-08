<?php
    session_start();
    try
    {
        include("dbconnect/connection.php");

        $productId=base64_decode($_GET['product-id']);

        $sql="select * from product_table where product_id={$productId} and is_deleted=0";
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_assoc($result);
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compnay Name</title>

    <link rel="shortcut icon" href="../img/facebook-icon.png" type="image/x-icon">

    <!-- font awesome cdn link -->
    <script src="https://kit.fontawesome.com/ca7271c9b6.js" crossorigin="anonymous"></script>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    
    <!-- main css file  -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/productPage.css">


</head>
<body>

    <!-- add product form  -->
    <div class="add-product-form-container">
        
    </div>

    <!-- main container  -->
    <div class="container">

        <!-- header part  -->
        <div class="header">
            <!-- upper header -->
            <div class="upper-header">
                <!-- logo part -->
                <div class="logo-container">
                    <div class="logo">
                        <img src="../img/facebook-icon.png" alt="">
                    </div>
                </div>

                <!-- search bar  -->
                <div class="search-bar-container">
                    <div class="search-bar">
                        <button class="search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <input type="search" name="search" id="search" placeholder="Search for Products, Brands and More">
                    </div>
                    <div class="live-search-result-container">
                        
                    </div>
                </div>
    
                <!-- upper nav-bar  -->
                <div class="nav-bar-container">
                    <div class="nav-item">
                        <a href="/e-commerce">Home</a>
                    </div>
                    <div class="nav-item">
                        <a href="#">Gallery</a>
                    </div>
                    <div class="nav-item">
                        <a href="#contact-us">Contact</a>
                    </div>
                    <div class="nav-item">
                        <a href="#">About</a>
                    </div>
                    <div class="nav-item">
                        <a href="#">Blog</a>
                    </div>
                </div>
            </div>

            <!-- lower header  -->
            <div class="lower-header">
                <?php include("megaMenu.php")?>
            </div>
        </div>

        <!-- middle part -->
        <div class="middle">
            <!-- braedcrumb  -->
            <?php require("breadCrumb.php") ?>

            <div class="product-item-container">
                <div class="product-item-container-left">
                    <div class="product-item-image">
                        <img src="../<?php echo($row['product_image']); ?>" alt="">
                        <div class="wishlist-icon-container" data-product-id="<?php echo($row['product_id']); ?>">
                            <i class="fa-solid fa-heart"

                        <?php
                            if(isset($_SESSION['user_id']))
                            {
                                include("dbconnect/connection.php");
                                $sql1="select * from wishlists where user_id={$_SESSION['user_id']} and product_id={$row['product_id']} and is_deleted=0";
                                $result1=mysqli_query($conn, $sql1);

                                if(mysqli_num_rows($result1)>0)
                                {
                                    echo 'style="color: rgb(255, 0, 0); text-shadow: 0 0 0px rgb(255 255 255);"';
                                }
                                else
                                {
                                    echo 'style="color: #fff;"';
                                }
                            }
                            ?>

                            ></i>
                        </div>
                    </div>
                    <div class="product-item-btn-container">
                        <a href="#" class="add-to-cart-btn" data-product-id="<?php echo($row['product_id']); ?>"><i class="fa-solid fa-cart-shopping"></i> &nbsp;&nbsp; Add to Cart</a>
                        <a href="/e-commerce/php/orderPage.php?product-id=<?php echo $_GET['product-id']; ?>" class="buy-now-btn" data-product-id="<?php echo($row['product_id']); ?>" target="_blank"><i class="fa-solid fa-bolt-lightning"></i> &nbsp;&nbsp; Buy Now</a>
                    </div>
                </div>
                <div class="product-item-container-right">

                    <div class="product-item-info-container">
                        <div class="product-name">
                            <p><?php echo($row['product_name']); ?></p>
                        </div>
                        <div class="product-ratings">
                            <p>4.5 &nbsp;<i class="fa-solid fa-star"></i></p>
                            <span>32,000 ratings</span>
                        </div>
                        <div class="product-price">
                            <p>&#8377; <?php echo(number_format($row['product_price'])); ?></p>
                        </div>

                        <div class="product-count">
                            <button class="product-count-minus">-</button>
                            <input type="number" value="1" name="product-count-value" id="product-count-value" min="1" onclick="this.select();">
                            <button class="product-count-plus">+</button>
                        </div>

                        <div class="product-desc">
                            <p><?php echo($row['product_desc']); ?></p>
                        </div>

                        <div class="product-specification-container">
                            <p class="product-specification-container-title">Specifications</p>


                            <table class="product-specification-table">

                                <?php 
                                    include("dbconnect/connection.php");
                                    // $sql1="select * from product_specifications_value_table where product_id={$productId}";
                                    // $sql1 = "select product_specifications_table.name as name, product_specifications_value_table.value as value from product_specifications_table JOIN product_specifications_value_table ON product_specifications_table.specification_id=product_specifications_value_table.specification_id;";

                                    $sql1 = "select * from product_specifications_table where product_id={$productId} and is_deleted=0;";


                                    $result1=mysqli_query($conn, $sql1);
                                    
                                    if(mysqli_num_rows($result1)>0)
                                    {
                                        while($row1=mysqli_fetch_assoc($result1))
                                        {
                                            echo('
                                            <tr class="product-specification">
                                                <td class="product-specification-name">
                                                    <p>'.$row1['name'].'</p>
                                                </td>
                                                <td class="product-specification-value">
                                                    <p>'.$row1['value'].'</p>
                                                </td>
                                            </tr>
                                            ');
                                        }
                                    }
                                
                                ?>
                                
                            </table>

                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- footer part -->
        <?php include("footer.php") ?>
    </div>



    <!-- javascript from here  -->
    <!-- jquery ui  -->
    <script src="../javascript/jquery-ui.min.js"></script>
    <!-- jquery ajax -->
    <script src="../javascript/jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            wishlistItemCount();
            cartItemCount();

            // set interval for looking wheather the searchbar  is empty or not 
            setInterval(isSearchBarEmpty, 100);

            //code for live search bar
             $(document).on("keyup", "#search", function(e) {
                e.preventDefault();
                
                if($("#search").val()=='')
                {
                    $(".live-search-result-container").css('display', 'none');
                }
                else
                {
                    let search_data=$("#search").val();                    
                    $.ajax({
                        url: "liveSearch.php",
                        type: "POST",
                        data: {search_data: search_data},
                        success: function(data)
                        {
                            $(".live-search-result-container").css('display', 'flex');
                            $(".live-search-result-container").html(data);
                        }
                    })
                }

            });


             // code for when user click on his order to view details
             $(document).on("click", ".order-item", function(e) {
                e.preventDefault();
                let order_id=$(this).data('order-id');
                console.log("order view  clicked "+order_id);
                $.ajax({
                    url: "viewOrder.php",
                    type: "POST",
                    data: {order_id: order_id},
                    success: function(data)
                    {
                        $(".add-product-form-container").html(data);
                        $(".add-product-form-container").css("display", "flex");
                    }
                })
            });

             // code for when click on  cart tab
             $(document).on("click", ".orders-menu", function(e) {
                e.preventDefault();
                console.log("orders clicked");
                loadOrders();

            });

            //code for when click on Place order button
            $(document).on("click", "#place-order-from-cart-btn-id", function(e) {
                e.preventDefault();
                console.log("place order button click");
                window.open("cartOrderPage.php", "_blank");

            });

            // code for when click on buy now
            $(document).on("click", ".buy-now-btn", async function(e) {
                e.preventDefault();
                let product_id=$(this).data("product-id");
                let product_count=$("#product-count-value").val();
                // console.log(product_id, "added to the cart and price is ", product_count);
                await $.ajax({
                    url: "addToCart.php",
                    type: "POST",
                    data: {product_id: product_id, product_count: product_count},
                    success: function(data) {
                        if (data == 0) {
                            console.log(product_id, "could not added to the cart");
                        } else if (data == 1) {
                            status = true;
                            console.log(product_id, "added to the cart");
                            window.open($('.buy-now-btn').attr('href'), '_blank');
                        } else if (data == 2) {
                            console.log("please log in");
                            window.location.href = "login.php";
                        } else if (data == 3) {
                            console.log(product_id, "updated to the cart");
                            // window.open("/e-commerce/php/orderPage.php");
                            window.open($('.buy-now-btn').attr('href'), '_blank');

                        } else if (data == 4) {
                            console.log(product_id, "could not updated to the cart");
                        } else {
                            console.log(data);
                        }
                        cartItemCount();
                    }
                });
            });

            // code for when click on decrease product-quantity in cart
            $(document).on("click", ".product-quantity-decrease", function(e) {
                e.preventDefault();
                let product_id=$(this).data("product-id");
                console.log(product_id, "decrese cart clicked");
                
                $.ajax({
                    url: "/e-commerce/php/decreaseQuantityInCart.php",
                    type: "POST",
                    data: {product_id: product_id},
                    success: function(data) {
                        if(data==1)
                        {
                            console.log(product_id, "quantity decreased in the cart");
                            loadCartItem();
                        }
                        else
                        {
                            console.log(product_id, "quantity could not be updated to the cart");
                            // console.log(data);
                        }
                        cartItemCount();
                    }
                });

            });

            // code for when click on increase product-quantity in cart
            $(document).on("click", ".product-quantity-increase", function(e) {
                e.preventDefault();
                let product_id=$(this).data("product-id");
                console.log(product_id, "increse cart clicked");
                
                $.ajax({
                    url: "/e-commerce/php/increaseQuantityInCart.php",
                    type: "POST",
                    data: {product_id: product_id},
                    success: function(data) {
                        if(data==1)
                        {
                            console.log(product_id, "quantity increased in the cart");
                            loadCartItem();
                        }
                        else
                        {
                            console.log(product_id, "quantity could not be updated to the cart");
                            console.log(data);
                        }
                        cartItemCount();
                    }
                });

            });


            // code for when click on remove button in cart page 
            $(document).on("click", ".remove-from-cart-btn", function(e) {
                e.preventDefault();
                let product_id=$(this).data("product-id");
                console.log(product_id, "remove from cart clicked");
                
                $.ajax({
                    url: "/e-commerce/php/deleteFromCart.php",
                    type: "POST",
                    data: {product_id: product_id},
                    success: function(data) {
                        if(data==1)
                        {
                            console.log(product_id, " deleted from the cart");
                            loadCartItem();
                        }
                        else
                        {
                            console.log(product_id, " could not be deleted from the cart");
                        }
                        cartItemCount();
                    }
                });

            });

            // code for when click on  cart tab
            $(document).on("click", ".cart-menu", function(e) {
                e.preventDefault();
                console.log("cart clicked");
                loadCartItem();
                cartItemCount();

            });


            // when clicked on add to cart btn on product page 
            $(document).on("click", ".add-to-cart-btn", async function(e){
                e.preventDefault();
                let product_id=$(this).data("product-id");
                let product_count=$("#product-count-value").val();
                // console.log(product_id, "added to the cart and price is ", product_count);
                await $.ajax({
                    url: "addToCart.php",
                    type: "POST",
                    data: {product_id: product_id, product_count: product_count},
                    success: function(data) {
                        if (data == 0) {
                            console.log(product_id, "could not added to the cart");
                        } else if (data == 1) {
                            status = true;
                            console.log(product_id, "added to the cart");
                        } else if (data == 2) {
                            console.log("please log in");
                            window.location.href = "login.php";
                        } else if (data == 3) {
                            console.log(product_id, "updated to the cart");
                        } else if (data == 4) {
                            console.log(product_id, "could not updated to the cart");
                        } else {
                            console.log(data);
                        }
                        cartItemCount();
                    }
                });
            });

            // code for when click on heart icon of wishlist
            $(document).on("click", ".wishlist-icon-container", async function(e) {
                e.preventDefault();
                let product_id = $(this).data("product-id");
                console.log(product_id, $(this));
                let status = false;
                await $.ajax({
                    url: "addWishlist.php",
                    type: "POST",
                    data: {
                        product_id: product_id
                    },
                    success: function(data) {
                        if (data == 0) {
                            console.log(product_id, "could not added to the wishlist");
                        } else if (data == 1) {
                            status = true;
                            console.log(product_id, "added to the wishlist");
                        } else if (data == 2) {
                            console.log("please log in");
                            window.location.href = "login.php";
                        } else if (data == 3) {
                            console.log(product_id, "removed from the wishlist");
                        } else if (data == 4) {
                            console.log(product_id, "could not removed from the wishlist");
                        } else {
                            console.log(data);
                        }
                        wishlistItemCount();
                    }
                });
                if (status) {
                    $(this).find('.fa-heart').css("color", "rgb(255, 0, 0)");
                    $(this).find('.fa-heart').css("text-shadow", "0 0 0px rgb(255 255 255)");
                } else {
                    $(this).find('.fa-heart').css("color", "#fff");
                    $(this).find('.fa-heart').css("text-shadow", "0 0 1px rgb(0 0 0)");
                }

            });


            // code for when click on trash icon in wishlist tab
            $(document).on("click", ".wishlist-delete-icon-container", async function(e) {
                e.preventDefault();
                let product_id = $(this).data("product-id");
                console.log(product_id, $(this));
                let status = false;
                await $.ajax({
                    url: "addWishlist.php",
                    type: "POST",
                    data: {
                        product_id: product_id
                    },
                    success: function(data) {
                        if (data == 0) {
                            console.log(product_id, "could not added to the wishlist");
                        } else if (data == 1) {
                            status = true;
                            console.log(product_id, "added to the wishlist");
                        } else if (data == 2) {
                            console.log("please log in");
                            window.location.href = "login.php";
                        } else if (data == 3) {
                            console.log(product_id, "removed from the wishlist");
                            loadWishlistItem();
                        } else if (data == 4) {
                            console.log(product_id, "could not removed from the wishlist");
                        } else {
                            console.log(data);
                        }
                        wishlistItemCount();
                    }
                });

            });

            // code for when click on  wishlist tab
            $(document).on("click", ".wishlist-menu", function(e) {
                e.preventDefault();
                console.log("wishlit clickd+");
                loadWishlistItem();
                wishlistItemCount();

            });


            // code for when click on pruduct count minus btn on product page
            $(document).on("click", ".product-count-minus", function(e) {
                e.preventDefault();
                let productCount=$("#product-count-value").val();
                if(productCount=='' || productCount==1 || productCount<1)
                {
                    $("#product-count-value").val(1);
                }
                else
                {
                    productCount -= 1;
                    $("#product-count-value").val(productCount);
                }
                console.log("value changed to ",productCount);
            });


            // code for when click on pruduct count plus btn on product page
            $(document).on("click", ".product-count-plus", function(e) {
                e.preventDefault();
                let productCount=$("#product-count-value").val();
                if(productCount!='')
                {
                    productCount=parseInt(productCount);
                }
                if(productCount=='' || productCount<1)
                {
                    $("#product-count-value").val(1);
                }
                else
                {
                    productCount += 1;
                    $("#product-count-value").val(productCount);
                }
                console.log("value changed to ",productCount);
            });

            // code for when on cahnge on pruduct count field product page
            $(document).on("keyup", "#product-count-value", function(e) {
                e.preventDefault();
                let productCount=$("#product-count-value").val();
                if(productCount!='')
                {
                    productCount=parseInt(productCount);
                }

                if(productCount=='' || productCount<1)
                {
                    $("#product-count-value").val(1);
                }
                console.log("value changed to ",productCount);
            });


//***********************************************************
//              function coding area start 
//***********************************************************

            // function for checking whether the search bar is empty or not  
            function isSearchBarEmpty()
            {
                if($("#search").val()=='')
                {
                    $(".live-search-result-container").css('display', 'none');
                }
            }

            // code for form close button 
            $(document).on("click", ".form-close-btn", function(e){
                // console.log("add clicked");
                $(".form-container").remove();
                $(".add-product-form-container").css("display", "none");
                $("body").css("overflow", "auto");
            });

             // function for loading orders 
             function loadOrders()
            {
                $.ajax({
                    url: "/e-commerce/php/loadOrdersItem.php",
                    type: "POST",
                    data: {},
                    success: function(data) {
                        $(".middle").html(data);
                    }
                });
            }

            // function for loading wishlists count
            function wishlistItemCount() {
                $.ajax({
                    url: "/e-commerce/php/wishlistItemCount.php",
                    type: "POST",
                    data: {},
                    success: function(data) {
                        $(".wishlist-counter-container").html(data);
                    }
                });
            }

            // function for loading cart count
            function cartItemCount() {
                $.ajax({
                    url: "/e-commerce/php/cartItemCount.php",
                    type: "POST",
                    data: {},
                    success: function(data) {
                        $(".cart-counter-container").html(data);
                    }
                });
            }

            // function for loading cart items
            function loadCartItem() {
                $.ajax({
                    url: "/e-commerce/php/loadCartItem.php",
                    type: "POST",
                    data: {},
                    success: function(data) {
                        $(".middle").html(data);
                    }
                });
            }


            // function for loading wishlists 
            function loadWishlistItem() {
                $.ajax({
                    url: "loadWishlistItem.php",
                    type: "POST",
                    data: {},
                    success: function(data) {
                        $(".middle").html(data);
                    }
                });
            }


            // function for loading item on home page 
            function loadProduct()
            {
                $.ajax({
                    url: "php/loadProduct.php",
                    type: "POST",
                    data: {},
                    success: function(data){
                        $(".product-item-container").html(data);
                    }
                });
            }

        });

    </script>
</body>
</html>