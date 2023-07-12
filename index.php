<?php
    session_start();
    if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='admin')
    {
        header("Location: /e-commerce/php/admin/");
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compnay Name</title>

    <link rel="shortcut icon" href="img/facebook-icon.png" type="image/x-icon">

    <!-- font awesome cdn link -->
    <script src="https://kit.fontawesome.com/ca7271c9b6.js" crossorigin="anonymous"></script>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- main css file  -->
    <link rel="stylesheet" href="css/style.css">


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
                        <img src="img/facebook-icon.png" alt="">
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
                <!-- menu bar in lower header  -->
                <?php include("php/megaMenu.php") ?>
            </div>

        </div>

        <!-- middle part -->
        <div class="middle">

            <!-- banner code from here  -->
            <div class="banner-container">
                <div class="my-slides fade">
                    <img src="img/banner/offer1.webp" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <div class="my-slides fade">
                    <img src="img/banner/chromebook_offer.webp" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <div class="my-slides fade">
                    <img src="img/banner/laptop_offer.webp" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <div class="my-slides fade">
                    <img src="img/banner/minipc_offer.webp" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>
                <div class="my-slides fade">
                    <img src="img/banner/flight_offer.webp" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <!-- <div class="banner" style="display: none;">
                    <p>Welcome to this site</p>
                    <a href="#">Get Started</a> 
                </div> -->

                <div class="slide-prev-btn" onclick="nextPrevSlides(-1)">&#10094;</div>
                <div class="slide-next-btn" onclick="nextPrevSlides(1)">&#10095;</div>
            </div>

            <!-- code for category  -->
            <div class="category-container">
                <!-- category item will be here  -->
            </div>

            <!-- code  for  credit card offers  -->

            <div class="card-container">
                <a href="#" class="card-img">
                    <img src="img/common/card_discount.webp" alt="">
                </a>
            </div>

            <!-- code  for  product  -->
            <div class="product-item-container">
                <!-- <a href="#" class="product-item">
                    <div class="product-item-img">
                        <img src="img/product/smartphones/realme.webp" alt="">
                    </div>
                    <div class="product-name">
                        <p>Realme C25</p>
                    </div>
                    <div class="product-price">
                        <p>From 10,499</p>
                    </div>
                    <div class="product-desc">
                        <p>6.72" 90Hz FHD+ Display</p>
                    </div>
                </a> -->

            </div>

            <!-- Showing associated company code from here-->
            <div class="associated-company-container">
                <h2>Our Clients</h2>
                <div class="company-logo-container">
                    <div class="company-logo-container-row">
                        <div class="company-logo">
                            <img src="img/facebook-icon.png" alt="">
                        </div>
                        <div class="company-logo">
                            <img src="img/amazon-icon.png" alt="">
                        </div>
                        <div class="company-logo">
                            <img src="img/facebook-icon.png" alt="">
                        </div>
                        <div class="company-logo">
                            <img src="img/amazon-icon.png" alt="">
                        </div>
                    </div>

                    <div class="company-logo-container-row">
                        <div class="company-logo">
                            <img src="img/amazon-icon.png" alt="">
                        </div>
                        <div class="company-logo">
                            <img src="img/facebook-icon.png" alt="">
                        </div>
                        <div class="company-logo">
                            <img src="img/amazon-icon.png" alt="">
                        </div>
                        <div class="company-logo">
                            <img src="img/facebook-icon.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer part -->
        <div class="footer">
            <div class="footer-upper">
                <div class="footer-column-container">
                    <div class="footer-column">
                        <p>Social Media</p>
                        <div class="footer-item">
                            <a href="#">
                                <i class="fa-brands fa-square-facebook"></i>
                            </a>
                        </div>
                        <div class="footer-item">
                            <a href="#">
                                <i class="fa-brands fa-square-twitter"></i>
                            </a>
                        </div>
                        <div class="footer-item">
                            <a href="#">
                                <i class="fa-brands fa-square-instagram"></i>
                            </a>
                        </div>
                        <div class="footer-item">
                            <a href="#">
                                <i class="fa-brands fa-square-youtube"></i>
                            </a>
                        </div>
                    </div>

                    <div class="footer-column">
                        <p>consumer policy</p>
                        <div class="footer-item">
                            <a href="#">F.A.Q</a>
                        </div>
                        <div class="footer-item">
                            <a href="#">Cookies Policy</a>
                        </div>
                        <div class="footer-item">
                            <a href="#">Terms Of Service</a>

                        </div>
                        <div class="footer-item">
                            <a href="#">Support</a>
                        </div>
                    </div>

                    <div class="footer-column">
                        <p>Contact Us</p>
                        <div class="footer-item-contact">
                            <!-- contact us form -->
                            <form action="/" method="post" class="contact-us-form" id="contact-us">
                                <input type="email" name="email" placeholder="Email" required>
                                <textarea name="message" placeholder="Message" id="message" cols="30" rows="5" style="resize: none;"></textarea>
                                <input type="submit" value="Send">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-lower">
                <p>Copyright &copy; 2021 company.com</p>
            </div>
        </div>
    </div>



    <!-- javascript from here  -->
    <!-- jquery ui  -->
    <script src="javascript/jquery-ui.min.js"></script>
    <!-- jquery ajax -->
    <script src="javascript/jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            loadCategory();
            loadProduct();
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
                window.open("php/cartOrderPage.php", "_blank");

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

            // code for when click on heart icon of wishlist
            $(document).on("click", ".wishlist-icon-container", async function(e) {
                e.preventDefault();
                let product_id = $(this).data("product-id");
                console.log(product_id, $(this));
                let status = false;
                await $.ajax({
                    url: "php/addWishlist.php",
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
                    $(this).find('.fa-heart').css("text-shadow", "0 0 1px #000");
                }

            });

            // code for when click on trash icon in wishlist tab
            $(document).on("click", ".wishlist-delete-icon-container", async function(e) {
                e.preventDefault();
                let product_id = $(this).data("product-id");
                console.log(product_id, $(this));
                let status = false;
                await $.ajax({
                    url: "php/addWishlist.php",
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

            // code for form close button 
            $(document).on("click", ".form-close-btn", function(e){
                // console.log("add clicked");
                $(".form-container").remove();
                $(".add-product-form-container").css("display", "none");
                $("body").css("overflow", "auto");
            });

            // code for order cancel button 
            $(document).on("click", "#cancel-order-user", function(e){
                // console.log("add clicked");
                // $("body").css("overflow", "auto");
                if(confirm('Do you Really want cancel order'))
                {
                    let order_id=$(this).data('order-id');
                    console.log(order_id);
                    $.ajax({
                        url: "/e-commerce/php/cancelOrder.php",
                        type: "POST",
                        data: {order_id: order_id},
                        success: function(data) {
                            if(data==1)
                            {
                                console.log('order canceled');
                                $('.user-operation-container').hide();
                            }
                            else if(data==0)
                            {
                                console.log('order could not be canceled');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }

            });


            //  ****************************************
            //          function coding area 
            //  ****************************************

            // function for checking whether the search bar is empty or not  
            function isSearchBarEmpty()
            {
                if($("#search").val()=='')
                {
                    $(".live-search-result-container").css('display', 'none');
                }
            }

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
                    url: "php/loadCartItem.php",
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
                    url: "php/loadWishlistItem.php",
                    type: "POST",
                    data: {},
                    success: function(data) {
                        $(".middle").html(data);
                    }
                });
            }

            // function for loading category 
            function loadCategory() {
                $.ajax({
                    url: "php/loadCategory.php",
                    type: "POST",
                    data: {},
                    success: function(data) {
                        $(".category-container").html(data);
                    }
                });
            }

            // function for loading item on home page 
            function loadProduct() {
                $.ajax({
                    url: "php/loadProduct.php",
                    type: "POST",
                    data: {},
                    success: function(data) {
                        $(".product-item-container").html(data);
                    }
                });
            }

            // call when click on any product 
            $(document).on("click", ".category-item", function(e) {

                const category_id = $(this).data("category-id");
                console.log(category_id);
                $.ajax({
                    url: "php/loadProductFromCategory.php",
                    type: "POST",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        $(".middle").html(data);
                    }
                });
            });

        });
    </script>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function nextPrevSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("my-slides");

            if (n > slides.length) {
                slideIndex = 1;
            }
            if (n < 1) {
                slideIndex = slides.length
            }

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slides[slideIndex - 1].style.display = "flex";
        }
    </script>
</body>

</html>