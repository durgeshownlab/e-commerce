<?php
    session_start();
    
    if(!isset($_SESSION['user_id']))
    {
        header("Location: login.php");
    }
    // echo $product_id;   

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
    <link rel="stylesheet" href="../css/orderPage.css">


</head>
<body>
    <!-- loading container  -->
    <div class="loading-container">
        <div class="loading">
            <i class="fa-solid fa-circle-notch"></i>
            Processing Your Order
        </div>
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
        </div>

        <!-- middle part -->
        <div class="middle">
            <div class="order-details-page-container">
                <div class="order-details-container">
                    <h3>Delivery Address</h3>
                    <div class="address-container">
                        <?php 
                            include("dbconnect/connection.php");
                            $sql="select * from address where user_id={$_SESSION['user_id']} and is_deleted=0";
                            $result=mysqli_query($conn, $sql);
                            
                            if(mysqli_num_rows($result)>0)
                            {
                                echo '
                                    <div class="existing-address-container">
                                ';
                                $count=1;
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    echo '
                                        <div class="existing-address">
                                            <input type="radio" name="address" id="address-id-'.$count.'" value="'.$row['address_id'].'">
                                            <label for="address-id-'.$count.'">
                                                <div class="address-line-1">
                                                    <p class="name">'.ucwords($row['name']).'</p>
                                                    <p class="address-type">'.strtoupper($row['address_type']).'</p>
                                                    <p class="number">'.$row['mobile'].'</p>
                                                </div>
                                                <div class="address-line-2">
                                                    <p class="full-address">'.ucwords($row['address']).', '.ucwords($row['city']).', '.$row['state'].', <span>'.ucwords($row['pin_code']).'</span></p>
                                                </div>

                                            </label>
                                        </div>
                                    ';
                                    $count++;
                                }
                                echo '
                                    <div class="add-new-address-container">
                                        <button id="add-new-address-btn"><i class="fa-solid fa-plus"></i> Add New Address</button>
                                    </div>
                                    </div>
                                ';
                            }
                            else
                            {
                                echo '
                                <form action="" method="post" id="delivery-address-form">
                            <div class="form-group">
                                <div class="form-customer-name">
                                    <span>Name</span>
                                    <input type="text" placeholder="Name" name="customer-name" id="customer-name" autofocus>
                                </div>
                                <div class="form-customer-number">
                                    <span>Mobile Number</span>
                                    <input type="text" placeholder="10-digit mobile number" name="customer-mobile-number" id="customer-mobile-number" minlength="10" maxlength="10">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-customer-pincode">
                                    <span>Pin Code</span>
                                    <input type="text" placeholder="Pincode" name="customer-pincode" id="customer-pincode" minlength="6" maxlength="6">
                                </div>
                                <div class="form-customer-locality">
                                    <span>Locality</span>
                                    <input type="text" placeholder="Locality" name="customer-locality" id="customer-locality">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-customer-full-address">
                                    <span>Addresss</span>
                                    <textarea placeholder="Address (Area and Street)" name="customer-full-address" id="customer-full-address" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-customer-city">
                                    <span>District/City/Town</span>
                                    <input type="text" placeholder="District/City/Town" name="customer-city" id="customer-city">
                                </div>
                                <div class="form-customer-state">
                                    <span>State</span>
                                    <select name="customer-state" id="customer-state"> 
                                        <option value="">Select a state</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                        <option value="Daman and Diu">Daman and Diu</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Puducherry">Puducherry</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-customer-address-type">
                                    <span>Address Type</span>
                                    <select name="customer-address-type" id="customer-address-type"> 
                                        <option value="">Select Adress type</option>
                                        <option value="home">Home</option>
                                        <option value="office">Office</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-delivery-address-submit">
                                    <input type="submit" value="Save And Continue" id="address-submit">
                                </div>
                            </div>
                        </form>
                                ';

                            }
                        ?>
                        <form action="" method="post" id="delivery-address-form">
                        </form>
                    </div>
                    <h3>Order Summary</h3>
                    <div class="cart-item">
                        <!-- code for card item information -->
                        <?php 
                            $sql="select * from product_table join cart on cart.product_id=product_table.product_id where cart.user_id={$_SESSION['user_id']} and product_table.is_deleted=0 and cart.is_deleted=0";
                            $result=mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    echo '
                                    <div class="cart-item-details-container">
                                        <div class="cart-item-image-container">
                                            <img src="/e-commerce/'.$row['product_image'].'" alt="">
                                        </div>
                                        <div class="cart-item-details">
                                            <div class="name-desc-container">
                                                <div class="cart-item-name">
                                                    '.$row['product_name'] .'
                                                </div>
                                                <div class="cart-item-desc">
                                                    '.$row['product_desc'].'
                                                </div>
                                            </div>
                                            
                                            <div class="quantity-container">
                                                <p>Quantity: &nbsp;</p>
                                                <p>'.$row['quantity'].'</p>
                                            </div>
                                            <div class="cart-item-price">
                                                ₹'.$row['product_price'] .'
                                            </div>

                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        ?>
                    
                    </div>
                    <h3>Payment Options</h3>
                    <div class="payment-option-container">
                        <div class="pod-payment-container">
                            <input type="radio" name="payment-method" id="pod-payment" value="pod">
                            <label for="pod-payment">Pay On Delivery</label>
                        </div>
                        <div class="online-payment-container">
                            <input type="radio" name="payment-method" id="online-payment" value="online">
                            <label for="online-payment">Online Payment</label>
                        </div>
<?php 
    $sql1="select address.name as name, address.mobile as mobile, address.address as address, user_table.email as email from address join user_table on address.user_id=user_table.user_id where address.user_id={$_SESSION['user_id']} and address.is_deleted=0 and user_table.is_deleted=0";
    $result1=mysqli_query($conn, $sql1);
    if(mysqli_num_rows($result1))
    {
        $row1=mysqli_fetch_assoc($result1);                                               
    }

?>
                        <div class="pay-now-container">
                            <form action="" method="POST" id="payment-form">
                                <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->

                                <button type="button" id="pay-now-button">Pay Now</button>
                            </form>
                        </div>
                        <form action="">
                                <input type="hidden" name="user_address_id" value="">
                                <input type="hidden" name="product_id" value="<?php //echo $product_id ?>">
                        </form>

                        <div class="order-now-container">
                            <div class="captcha-container">
                                <div class="captcha">
                                    
                                </div>
                                <div class="captcha-input-container">
                                    <input type="text" name="captcha" id="captcha" placeholder="Enter Captcha Code" minlength="4" maxlength="4">
                                </div>
                            </div>
                            <button type="button" id="order-now-button">Order Now</button>
                        </div>
                    </div>

                </div>

                <!-- code for all cart item price and other details  -->
                <?php 
                    $sql="select * from cart where user_id={$_SESSION['user_id']} and is_deleted=0";
                    $result=mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)>0)
                    {
                        $total_price=0;
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $total_price +=$row['total_price'];
                        }
                    }
                ?>
                <div class="cart-price-details-container">
                    <div class="price-details-heading">
                        Price Details
                    </div>
                    <div class="price-details-info-container">
                        <div class="price-info">
                            <div class="product-count">Price (<?php echo mysqli_num_rows($result); ?>) items</div>
                            <div class="price-ammount">₹<?php echo number_format($total_price) ?></div>
                        </div>
                        <div class="discount-info">
                            <div class="discount-name">Discount</div>
                            <div class="discount-ammount">&minus; ₹0</div>
                        </div>
            
                        <div class="delivery-info">
                            <div class="delivery-name">Delivery Charges</div>
                            <div class="delivery-ammount">Free</div>
                        </div>
            
                        <div class="total-price-info">
                            <div class="total-price-name">Total Amount</div>
                            <div class="total-ammount">₹<?php echo number_format($total_price) ?></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- javascript from here  -->
    <!-- jquery ui  -->
    <script src="/e-commerce/javascript/jquery-ui.min.js"></script>
    <!-- jquery ajax -->
    <script src="/e-commerce/javascript/jquery.js"></script>

    <!-- rezor pay  -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".pay-now-container").hide();
            $(".order-now-container").hide();
            // $(".cart-item").hide();
            $(".payment-option-container").hide();
            

            //00000000000000000000000000000000000000000000000000000000000000000000000
            //      code for razor pay 
            //000000000000000000000000000000000000000000000000000000000000000000000000

            $('#pay-now-button').click(function() {
                // Get payment form data
                var formData = {
                    name: '<?php echo $row1['name'];?>',
                    email: '<?php echo $row1['email'];?>',
                    mobile: '<?php echo '91'.$row1['mobile'];?>'
                    // Include additional payment form data (e.g., name, email, etc.)
                    // ...
                };
                
                // console.log(formData.productId);
                // Make an AJAX call to create an order
                $.ajax({
                    type: 'POST',
                    url: 'createOrderForCart.php',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    success: function(response) {
                        // Order creation successful
                        // Process the response to get the order ID
                        var orderId = response.order_id;
                        var amount = response.amount;
                        var currency = response.currency;

                        // Create the Razorpay payment instance
                        var options = {
                            key: 'rzp_test_BNtnLwBYDkoxIF', // Replace with your actual Razorpay API key
                            amount: amount,
                            currency: currency,
                            name: 'E-commerce', // Replace with your company name
                            description: 'Payment for e-commerce', // Replace with payment description
                            order_id: orderId,
                            prefill:
                            {
                                name: formData.name,
                                email: formData.email,
                                contact: formData.mobile,
                            },
                            handler: function(response) {
                                // Handle the payment success
                                // Perform any additional actions (e.g., updating the database, displaying success message, etc.)
                                const razorpay_payment_id=response.razorpay_payment_id;
                                const razorpay_order_id=response.razorpay_order_id;
                                const razorpay_signature=response.razorpay_signature;

                                let address_id=$('input[name="user_address_id"]').val();
                                
                                console.log(razorpay_order_id, razorpay_payment_id, razorpay_signature, address_id);
                                console.log('Payment successful');
                                $('.loading-container').css('display', 'flex');
                                $.ajax({
                                    url: "storeOrderDetailsForCart.php",
                                    type: "POST",
                                    data: {razorpay_order_id: razorpay_order_id, razorpay_payment_id: razorpay_payment_id, address_id: address_id, payment_mode: 'online'},
                                    success: function(data)
                                    {
                                        console.log(data);
                                        data=JSON.parse(data);
                                        let product_details=JSON.stringify(data.data);
                                        if(data.status == 1)
                                        {
                                            $.ajax({
                                                url: "convertStringToBase64.php",
                                                type: "POST",
                                                data: {text: product_details},
                                                success: function(data)
                                                {
                                                    console.log("Successfully ordered");
                                                    $('.loading-container').css('display', 'none');
                                                    window.open('/e-commerce/php/successForCart.php?data='+data, '_self');
                                                }
                                            });
                                        }
                                        else if(data.status == 0)
                                        {
                                            console.log("Failed to order");
                                            window.open('/e-commerce/php/failure.php', '_self');
                                        }
                                        else
                                        {
                                            console.log(data);
                                        }
                                    }
                                });

                            },
                        
                    };

                    var rzp = new Razorpay(options);
                    rzp.open();
                },
                error: function(xhr, status, error) {
                    // Error handling
                    console.log(error);
                }
                });
            });

            //000000000000000000000000000000000000000000000000000000000000000000000000
            //  code for pay on delivery
            //000000000000000000000000000000000000000000000000000000000000000000000000
            $(document).on("click", "#order-now-button", function(e){
                console.log("pay on delivery");
                let address_id=$('input[name="user_address_id"]').val();
                
                let backend_captcha=$('.captcha').attr('data-captcha');
                let user_captcha=parseInt($('#captcha').val());
                
                console.log(backend_captcha, user_captcha);
                if(backend_captcha=='' || user_captcha=='')
                {
                    alert("Please Enter Captcha Code");
                }
                else if(backend_captcha!=user_captcha)
                {
                    alert("Please Enter Valid Captcha Code");
                }
                else if(backend_captcha==user_captcha)
                {
                    $('.loading-container').css('display', 'flex');
                    $.ajax({
                        url: "storeOrderDetailsForCart.php",
                        type: "POST",
                        data: {address_id: address_id, payment_mode: 'pod'},
                        success: function(data)
                        {
                            data=JSON.parse(data)
                            let product_details=JSON.stringify(data.data);
                            console.log(data);
                            console.log(data.status);
                            if(data.status==1)
                            {
                                $.ajax({
                                    url: "convertStringToBase64.php",
                                    type: "POST",
                                    data: {text: product_details},
                                    success: function(data)
                                    {
                                        console.log("Successfully ordered");
                                        $('.loading-container').css('display', 'none');
                                        window.open('/e-commerce/php/successForCart.php?data='+data, '_self');
                                    }
                                });
                            }
                            else if(data.status==0)
                            {
                                console.log("Failed to order");
                                window.open('/e-commerce/php/failure.php', '_self');
                            }
                            
                        }
                    });
                }

            })


            // code for when onchange occur on address radio 
            $(document).on('change', 'input[name="address"]', function(e) {
                let user_address_id = $(this).val();
                console.log('Selected value:', user_address_id);
                $('input[name="user_address_id"]').val(user_address_id);
                $(".cart-item-details-container").css("display", "flex");
                $(".payment-option-container").show();
            });

            // code for when onchange occur on payment option radio 
            $(document).on('change', 'input[name="payment-method"]', function(e) {
                var selectedValue = $(this).val();
                console.log('Selected value:', selectedValue);
                if(selectedValue=='pod')
                {
                    let captcha=generateRandomNumber();
                    $(".captcha").html(captcha);
                    $(".captcha").attr("data-captcha", captcha);

                    $(".pay-now-container").hide();
                    $(".order-now-container").show();
                }
                else if(selectedValue=='online')
                {
                    $(".pay-now-container").show();
                    $(".order-now-container").hide();
                }
            });
            
            // code for when click on add new address btn 
            $(document).on("click", "#add-new-address-btn", function(e){
                let form=`
                            <div class="form-group">
                                <div class="form-customer-name">
                                    <span>Name</span>
                                    <input type="text" placeholder="Name" name="customer-name" id="customer-name" autofocus>
                                </div>
                                <div class="form-customer-number">
                                    <span>Mobile Number</span>
                                    <input type="text" placeholder="10-digit mobile number" name="customer-mobile-number" id="customer-mobile-number" minlength="10" maxlength="10">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-customer-pincode">
                                    <span>Pin Code</span>
                                    <input type="text" placeholder="Pincode" name="customer-pincode" id="customer-pincode" minlength="6" maxlength="6">
                                </div>
                                <div class="form-customer-locality">
                                    <span>Locality</span>
                                    <input type="text" placeholder="Locality" name="customer-locality" id="customer-locality">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-customer-full-address">
                                    <span>Addresss</span>
                                    <textarea placeholder="Address (Area and Street)" name="customer-full-address" id="customer-full-address" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-customer-city">
                                    <span>District/City/Town</span>
                                    <input type="text" placeholder="District/City/Town" name="customer-city" id="customer-city">
                                </div>
                                <div class="form-customer-state">
                                    <span>State</span>
                                    <select name="customer-state" id="customer-state"> 
                                        <option value="">Select a state</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                        <option value="Daman and Diu">Daman and Diu</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Puducherry">Puducherry</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-customer-address-type">
                                    <span>Address Type</span>
                                    <select name="customer-address-type" id="customer-address-type"> 
                                        <option value="">Select Adress type</option>
                                        <option value="home">Home</option>
                                        <option value="office">Office</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-delivery-address-cancel">
                                    <input type="button" value="Cancel" id="address-cancel">
                                </div>
                                <div class="form-delivery-address-submit">
                                    <input type="submit" value="Save And Continue" id="address-submit">
                                </div>
                            </div>
                `;
                console.log("add new address clicked");
                $("#delivery-address-form").show(); 
                $("#add-new-address-btn").hide(); 
                $("#delivery-address-form").html(form);


            });

            $(document).on("click", "#address-cancel", function(e){
                $("#delivery-address-form").html('');
                $("#delivery-address-form").hide(); 
                $("#add-new-address-btn").show(); 
            });
            // code for when saving delivery address 
            $(document).on("submit", "#delivery-address-form", function(e){
                e.preventDefault();
                console.log("form submit  btn clicked");
                let customer_name=$("#customer-name").val();
                let customer_mobile_number=$("#customer-mobile-number").val();
                let customer_pincode=$("#customer-pincode").val();
                let customer_locality=$("#customer-locality").val();
                let customer_full_address=$("#customer-full-address").val();
                let customer_city=$("#customer-city").val();
                let customer_state=$("#customer-state").val();
                let customer_address_type=$("#customer-address-type").val();

                if(customer_name=='')
                {
                    alert("Please enter name");
                }
                else if(containsNumber(customer_name))
                {
                    alert("Name should not contain number");
                }
                else if(customer_mobile_number=='')
                {
                    alert("Please enter mobile number");
                }
                else if(!isValidPhoneNumber(customer_mobile_number))
                {
                    alert("Please enter a valid mobile number");
                }
                else if(customer_pincode=='')
                {
                    alert("Please enter pin code");
                }
                else if(!isValidPinCode(customer_pincode))
                {
                    alert("Please enter a valid pin code");
                }
                else if(customer_locality=='')
                {
                    alert("Please enter locality");
                }
                else if(customer_full_address=='')
                {
                    alert("Please enter address");
                }
                else if(customer_city=='')
                {
                    alert("Please enter city");
                }
                else if(customer_state=='')
                {
                    alert("Please select state");
                }
                else if(customer_address_type=='')
                {
                    alert("Please select Address type");
                }
                else
                {
                    let formData=new FormData(this);
                    $.ajax({
                        url: "addAddress.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==1)
                            {

                                console.log("inserted");
                                $("#customer-name").val('');
                                $("#customer-mobile-number").val('');
                                $("#customer-pincode").val('');
                                $("#customer-locality").val('');
                                $("#customer-full-address").val('');
                                $("#customer-city").val('');
                                $("#customer-state").val('');
                                $("#customer-address-type").val('');
                                location.reload();

                            }
                            else if(data==0)
                            {
                                alert("could not insert");
                            }
                            else
                            {
                                alert(data);
                            }
                        }
                    });
                    console.log(customer_name, customer_mobile_number, customer_pincode, customer_locality, customer_full_address, customer_city, customer_state);
                }
            });

            //code for generating random number
            function generateRandomNumber()
            {
                var min = 1000;
                var max = 9999;
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            //code for form validation
            function customFormValidation()
            {
                let user_address_id = $('input[name="address"]').val();
                $('input[name="user_address_id"]').val(user_address_id);
                return true;
            }

            // Helper function to validate email format
            function isValidEmail(email) {
            var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
            return emailRegex.test(email);
            }

            // Helper function to validate phone number format
            function isValidPhoneNumber(phone) {
            var phoneRegex = /^\d{10}$/;
            return phoneRegex.test(phone);
            }

            // Helper function to validate pincode format
            function isValidPinCode(pincode) {
            var pincodeRegex = /^\d{6}$/;
            return pincodeRegex.test(pincode);
            }

            // Helper function to check if a string contains a number
            function containsNumber(str) {
            var numberRegex = /\d/;
            return numberRegex.test(str);
            }
        });
    </script>

</body>
</html>