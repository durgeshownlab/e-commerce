<?php
    session_start();

    if(!isset($_SESSION['user_type']) && $_SESSION['user_type']!='admin' && !isset($_SESSION['email']))
    {
        header("Location: ../login.php");
    }
    if($_SESSION['user_type']!='admin')
    {
        header("Location: /e-commerce");
    }

    // echo($_SESSION['user_id']." ".$_SESSION['name']." ".$_SESSION['email']." ".$_SESSION['user_type']."");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | E-commerce</title>

    
    <link rel="shortcut icon" href="../../img/facebook-icon.png" type="image/x-icon">

    <!-- font awesome cdn link -->
    <script src="https://kit.fontawesome.com/ca7271c9b6.js" crossorigin="anonymous"></script>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    
    <!-- main css file  -->
    <link rel="stylesheet" href="../../css/admin.css">
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>

    <!-- add product form  -->
    <div class="add-product-form-container">
        
    </div>

    <!-- main container  -->
    <div class="container">

        <!-- code for header  -->
        <div class="header">
            <div class="menu-container">
                <div class="menu active" id="product">
                    Product
                </div>
                <div class="menu" id="category">
                    Category
                </div>
                <div class="menu" id="sub-category">
                    Sub Category
                </div>
                <div class="menu" id="order">
                    Orders
                </div>
            </div>
            <div class="log-out-container">
                <a href="../logout.php">Log Out</a>
            </div>
        </div>

        <!-- code for middle -->

        <div class="middle">
            <!-- product or category table will be here  -->
        </div>

    </div>

    <!-- javascript from here  -->
    
    <!-- jquery ui  -->
    <!-- <script src="../../javascript/jquery-ui.min.js"></script> -->
    <!-- jquery ajax -->
    <!-- <script src="../../javascript/jquery.js"></script> -->

    <!-- jquery cdn links  -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){

            // console.log("ready");
            loadProduct();

            // when click on product tab 
            $(document).on("click", "#product", function(e){
                // $(".middle").html("product");
                $(".menu").removeClass("active");
                $("#product").addClass("active");
                loadProduct();
            });

            // when click on category tab 
            $(document).on("click", "#category", function(e){
                $(".menu").removeClass("active");
                $("#category").addClass("active");
                loadCategory();

            });

            // when click on sub category tab 
            $(document).on("click", "#sub-category", function(e){
                $(".menu").removeClass("active");
                $("#sub-category").addClass("active");
                loadSubCategoryPage();
            });

            // when click on Orders tab
            $(document).on("click", "#order", function(e){
                $(".menu").removeClass("active");
                $("#order").addClass("active");
                loadOrders();
                // $('.middle').html('orders');
            });


            //  **************************************************************
            //      from here i will code for product tab in admin pannel
            //  ************************************************************** 

            // when click on delete product  btn
            $(document).on("click", ".product-delete-btn", function(e){
                if(confirm("Are you sure, You want to delete"))
                {
                    const product_id=$(this).data('product-id');
                    console.log(product_id);
    
                    $.ajax({
                        url: "adminDeleteProduct.php",
                        type: "POST",
                        data: {product_id: product_id},
                        success: function(data){
                            if(data==1)
                            {
                                loadProduct();
                                console.log("Product deleted");
                            }
                            else if(data==0)
                            {
                                loadProduct();
                                alert("could not delete Product");
                            }
                        }
                    });
                }
            });

            // when click on add product  btn
            $(document).on("click", "#add-product-btn-id", function(e){
                // console.log("add clicked");
                $.ajax({
                    url: "adminLoadAddProductForm.php",
                    type: "POST",
                    data: {},
                    success: function(data){
                        $(".add-product-form-container").html(data);
                        $(".add-product-form-container").css("display", "flex");
                    }
                });
            });


            // when click on update product  btn in admin pannel
            $(document).on("click", ".product-update-btn", function(e){

                let product_id=$(this).data("product-id");

                console.log("update ",product_id," clicked");
                $.ajax({
                    url: "adminLoadUpdateProductForm.php",
                    type: "POST",
                    data: {product_id: product_id},
                    success: function(data){
                        $(".add-product-form-container").html(data);

                        //  code for loading the product specification value
                        $.ajax({
                            url: "loadProductSpecificationInUpdateForm.php",
                            type: "POST",
                            data: {product_id: product_id},
                            success: function(data){
                                $('.form-product-specifications-container').html(data);
                                $(".add-product-form-container").css("display", "flex");
                            }
                        });

                    }
                });
            });


            // when click on update product  btn
            $(document).on("submit", "#update-product-form-id", function(e){
                console.log("update clicked");
                e.preventDefault();
                let product_name=$("#product-name").val();
                let product_price=$("#product-price").val();
                let product_image=$("#product-image").val();
                let product_desc=$("#product-desc").val();
                
                if(product_name=='')
                {
                    alert("Please Enter product name");   
                    $("#product-name").attr("autofocus");
                }
                else if(product_price=='')
                {
                    alert("Please Enter product price");
                    $("#product-price").attr("autofocus");
                }
                else if(product_desc=='')
                {
                    alert("Please Enter product description");
                    $("#product-desc").attr("autofocus");
                }
                else
                {
                    // $('#myform')[0]

                    let formData=new FormData(this);
                    $.ajax({
                        url: "adminUpdateProduct.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==1)
                            {
                                console.log("inserted");
                                $("#product-name").val('');
                                $("#product-price").val('');
                                $("#product-image").val('');
                                $("#product-desc").val('');

                                $(".add-product-form-container").css("display", "none");
                                loadProduct();

                            }
                            else if(data==0)
                            {
                                alert("could not update");
                            }
                            else
                            {
                                alert(data);
                            }
                        }
                    });
                    console.log(product_name, product_price, product_image, product_desc);
                }

            });

            // when click on Save product  btn
            $(document).on("submit", "#add-product-form-id", function(e){
                // console.log("add clicked");
                e.preventDefault();
                let product_name=$("#product-name").val();
                let product_price=$("#product-price").val();
                let product_image=$("#product-image").val();
                let product_category=$("#product-category").val();
                let product_sub_category=$("#product-sub-category").val();
                let product_desc=$("#product-desc").val();
                
                if(product_name=='')
                {
                    alert("Please Enter product name");   
                    $("#product-name").attr("autofocus");
                }
                else if(product_price=='')
                {
                    alert("Please Enter product price");
                    $("#product-price").attr("autofocus");
                }
                else if(product_image=='')
                {
                    alert("Please select product image");
                    $("#product-image").attr("autofocus");
                }
                else if(product_category=='')
                {
                    alert("Please select product category");
                    $("#product-category").attr("autofocus");
                }
                else if(product_sub_category=='')
                {
                    alert("Please select product sub category");
                    $("#product-category").attr("autofocus");
                }
                else if(product_desc=='')
                {
                    alert("Please Enter product description");
                    $("#product-desc").attr("autofocus");
                }
                else
                {
                    // $('#myform')[0]

                    let formData=new FormData(this);
                    $.ajax({
                        url: "adminAddProduct.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==1)
                            {
                                console.log("inserted");
                                $("#product-name").val('');
                                $("#product-price").val('');
                                $("#product-image").val('');
                                $("#product-category").val('');
                                $("#product-sub-category").val('');
                                $("#product-desc").val('');

                                $(".add-product-form-container").css("display", "none");
                                loadProduct();

                            }
                            else if(data==0)
                            {
                                alert("could not Insert");
                            }
                            else
                            {
                                alert(data);
                            }
                        }
                    });
                    console.log(product_name, product_price, product_image, product_category, product_desc);
                }

            });

            // code for on change on category dropdown in add product form
            $(document).on("change", "#product-category", function(e){
                let category_id=$("#product-category").val();
                console.log("change  detected", category_id);

                $.ajax({
                    url: "loadSubCategory.php",
                    type: "POST",
                    data: {category_id: category_id},
                    success: function(data){
                        $('#product-sub-category').html(data);
                    }
                });
            });

            // code for when click on add specificaton field button it wwill add one specification field 
            $(document).on("click", ".add-specification-field-btn", function(e){
                e.preventDefault();
                let number_of_specification=Number($("#number-of-specification").val());
                console.log("specification added ", number_of_specification);

                number_of_specification +=1;

                let specificationField=`
                <div class="form-group">
                    <div class="form-product-specification-name">
                        <input type="text" placeholder="Name" name="product-specification-name-${number_of_specification}" id="product-specification-name-${number_of_specification}">
                    </div>
                    <div class="form-product-specification-value">
                        <input type="text" placeholder="Value" name="product-specification-value-${number_of_specification}" id="product-specification-value-${number_of_specification}">
                    </div>
                </div>`;

                $("#number-of-specification").val(number_of_specification);
                $(".form-product-specifications-container").append(specificationField);
            });



            // code for form close button 
            $(document).on("click", ".form-close-btn", function(e){
                // console.log("add clicked");
                $(".form-container").remove();
                $(".add-product-form-container").css("display", "none");
                $("body").css("overflow", "auto");
            });


            //  **************************************************************
            //      from here i will code for category tab in admin pannel
            //  **************************************************************
            
            // when click on add category  btn form will be shown
            $(document).on("click", "#add-category-btn-id", function(e){
                console.log("add clicked");
                $.ajax({
                    url: "adminLoadAddCategoryForm.php",
                    type: "POST",
                    data: {},
                    success: function(data){
                        $(".add-product-form-container").html(data);
                        $(".add-product-form-container").css("display", "flex");
                    }
                });
            });

            // when click on Save Category
            $(document).on("submit", "#add-category-form-id", function(e){
                // console.log("add clicked");
                e.preventDefault();
                let category_name=$("#category-name").val();
                let category_image=$("#category-image").val();
                
                if(category_name=='')
                {
                    alert("Please Enter category name");   
                    $("#category-name").attr("autofocus");
                }
                else if(category_image=='')
                {
                    alert("Please Enter category image");
                    $("#category-image").attr("autofocus");
                }
                else
                {
                    // $('#myform')[0]

                    let formData=new FormData(this);
                    $.ajax({
                        url: "adminAddCategory.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==1)
                            {
                                console.log("inserted");
                                $("#category-name").val('');
                                $("#category-image").val('');

                                $(".add-product-form-container").css("display", "none");
                                loadCategory();

                            }
                            else if(data==0)
                            {
                                alert("could not Insert");
                            }
                            else
                            {
                                alert(data);
                            }
                        }
                    });
                    console.log(category_name, category_image);
                }

            });

            // when click on update category  btn
            $(document).on("submit", "#update-category-form-id", function(e){
                console.log("update clicked");
                e.preventDefault();
                let category_name=$("#category-name").val();
                let category_image=$("#category-image").val();
                
                if(category_name=='')
                {
                    alert("Please Enter category name");   
                    $("#category-name").attr("autofocus");
                }
                else
                {
                    // $('#myform')[0]

                    let formData=new FormData(this);
                    $.ajax({
                        url: "adminUpdateCategory.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==1)
                            {
                                console.log("inserted");
                                $("#category-name").val('');
                                $("#category-image").val('');

                                $(".add-product-form-container").css("display", "none");
                                loadCategory();

                            }
                            else if(data==0)
                            {
                                alert("could not Update");
                            }
                            else
                            {
                                alert(data);
                            }
                        }
                    });
                    console.log(category_name, category_image);
                }

            });

            // when click on delete category  btn
            $(document).on("click", ".category-delete-btn", function(e){
                if(confirm("Are you sure, You want to delete"))
                {
                    const category_id=$(this).data('category-id');
                    console.log(category_id);

                    $.ajax({
                        url: "adminDeleteCategory.php",
                        type: "POST",
                        data: {category_id: category_id},
                        success: function(data){
                            loadCategory();
                            if(data==1)
                            {
                                loadCategory();
                                console.log("Product deleted");
                            }
                            else if(data==0)
                            {
                                loadCategory();
                                alert("could not delete Product");
                            }
                        }
                    });
                }
            });

            // when click on update category btn in admin pannel
            $(document).on("click", ".category-update-btn", function(e){

                let category_id=$(this).data("category-id");

                console.log("update ",category_id," clicked");
                $.ajax({
                    url: "adminLoadUpdateCategoryForm.php",
                    type: "POST",
                    data: {category_id: category_id},
                    success: function(data){
                        $(".add-product-form-container").html(data);
                        $(".add-product-form-container").css("display", "flex");
                    }
                });
            });


            //  *******************************************************************
            //      from here i will code for sub-category tab in admin pannel
            //  *******************************************************************

            // code for when cick on sub category delete btn 

            $(document).on("click", ".sub-category-delete-btn", function(e){
                if(confirm("Are you sure, You want to delete"))
                {
                    let sub_category_id=$(this).data("sub-category-id");
                    console.log(sub_category_id);

                    $.ajax({
                        url: "adminDeleteSubCategory.php",
                        type: "POST",
                        data: {sub_category_id: sub_category_id},
                        success: function(data){
                            let category_id = $("#category-id-of-subcategory-page").val();
                            console.log(category_id);
                            if(data==1)
                            {
                                loadSubCategory(category_id);

                                console.log("Product deleted");
                            }
                            else if(data==0)
                            {
                                loadSubCategory(category_id);
                                alert("could not delete Product");
                            }
                        }
                    });
                }
            });

            // when on change occurs on sub category page load related subcategory
            $(document).on("change", "#category-id-of-subcategory-page", function(e){
                    let category_id = $("#category-id-of-subcategory-page").val();
                    console.log(category_id);

                    loadSubCategory(category_id);
            });

             // when click on add sub category  btn form will be load
             $(document).on("click", "#add-sub-category-btn-id", function(e){
                let category_id = $("#category-id-of-subcategory-page").val();
                console.log(category_id);
                console.log("add clicked");
                $.ajax({
                    url: "adminLoadAddSubCategoryForm.php",
                    type: "POST",
                    data: {category_id: category_id},
                    success: function(data){
                        $(".add-product-form-container").html(data);
                        $(".add-product-form-container").css("display", "flex");
                    }
                });
            });

            // when click on Save sub Category
            $(document).on("submit", "#add-sub-category-form-id", function(e){
                // console.log("add clicked");
                e.preventDefault();
                let sub_category_name=$("#sub-category-name").val();
                let category_id=$("#category-id").val();
                
                if(sub_category_name=='')
                {
                    alert("Please Enter sub category name");   
                    $("#sub-category-name").attr("autofocus");
                }
                else if(category_id=='')
                {
                    alert("Please Enter category id");
                }
                else
                {
                    // $('#myform')[0]

                    let formData=new FormData(this);
                    $.ajax({
                        url: "adminAddSubCategory.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==1)
                            {
                                console.log("inserted");
                                $("#sub-category-name").val('');

                                $(".add-product-form-container").css("display", "none");
                                loadSubCategory(category_id);

                            }
                            else if(data==0)
                            {
                                alert("could not Insert");
                            }
                            else
                            {
                                alert(data);
                            }
                        }
                    });
                    console.log(sub_category_name, category_id);
                }

            });

            // when click on update btn in sub-category tab of admin pannel
            $(document).on("click", ".sub-category-update-btn", function(e){
                let sub_category_id=$(this).data("sub-category-id");

                console.log("update ",sub_category_id," clicked");
                $.ajax({
                    url: "adminLoadUpdateSubCategoryForm.php",
                    type: "POST",
                    data: {sub_category_id: sub_category_id},
                    success: function(data){
                        $(".add-product-form-container").html(data);
                        $(".add-product-form-container").css("display", "flex");
                    }
                });
            });

            // when click on update sub category btn in form
            $(document).on("submit", "#update-sub-category-form-id", function(e){
                console.log("update clicked");
                e.preventDefault();
                let sub_category_name=$("#sub-category-name").val();
                let sub_category_id=$("#sub-category-id").val();
                let category_id=$("#sub-category-id").val();
                
                if(sub_category_name=='')
                {
                    alert("Please Enter sub category name");
                }
                else
                {
                    // $('#myform')[0]

                    let formData=new FormData(this);
                    $.ajax({
                        url: "adminUpdateSubCategory.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==1)
                            {
                                console.log("inserted");
                                $("#sub-category-name").val('');

                                $(".add-product-form-container").css("display", "none");

                                let category_id = $("#category-id-of-subcategory-page").val();
                                loadSubCategory(category_id);

                            }
                            else if(data==0)
                            {
                                alert("could not Update");
                            }
                            else
                            {
                                alert(data);
                            }
                        }
                    });
                    console.log(sub_category_name, sub_category_id);
                }

            });
            
            //  *******************************************************************
            //      from here i will code for orders tab in admin pannel
            //  *******************************************************************

            // code for when cick on sub category delete btn 

            $(document).on("click", ".product-view-btn", function(e){
                let order_id=$(this).data("order-id");
                console.log(order_id);

                $.ajax({
                    url: "adminViewOrder.php",
                    type: "POST",
                    data: {order_id: order_id},
                    success: function(data){
                        $(".add-product-form-container").css('display', 'flex');
                        $("body").css('overflow', 'hidden');
                        $(".add-product-form-container").html(data);

                    }
                });
            });

            // code for updating the delivery status 
            $(document).on("change", "#delivery-status", function(e){
                let delivery_status=$('#delivery-status').val();
                let order_id=$('[name="order-id"]').val();
                console.log(delivery_status+"........."+order_id);

                $.ajax({
                    url: "adminUpdateDeliveryStatus.php",
                    type: "POST",
                    data: {order_id: order_id, delivery_status: delivery_status},
                    success: function(data){
                        if(data==1)
                        {
                            console.log('order status changed to ', delivery_status);
                            loadOrders();
                        }
                        else if(data==0)
                        {
                            console.log('failed to changed');
                        }
                        else
                        {
                            console.log(data);
                        }
                    }
                });
            });

            //code for reloading the orders
            $(document).on("click", ".reload-order-btn", function(e){
                console.log("order reloaded");
                loadOrders();
            });


        //***************************************************
        //      code for filter 
        //***************************************************

            //code for payment method on change
            $(document).on("change", "input[name=\"payment-mode[]\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let delivery_status = [];

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                let order_status=0;

                if($('#order-status-filter').is(':checked'))
                {
                    order_status = 1;
                    console.log("Checkbox value:", order_status);
                }

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'adminSortFilterOrders.php',
                    type: 'POST',
                    data: { payment_method: payment_method, delivery_status: delivery_status, sort_by: sort_by, order_status: order_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, order_status, sort_by, from_date, to_date);
                        $('.product-item-container').html(data);
                    }
                });
            });

            //code for delivery status on change
            $(document).on("change", "input[name=\"delivery-status[]\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();
                let payment_method = [];
                let delivery_status = [];
                let order_status=0;

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                if($('#order-status-filter').is(':checked'))
                {
                    order_status = 1;
                    console.log("Checkbox value:", order_status);
                }

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'adminSortFilterOrders.php',
                    type: 'POST',
                    data: { payment_method: payment_method, delivery_status: delivery_status, sort_by: sort_by, order_status: order_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, order_status, from_date, to_date);
                        $('.product-item-container').html(data);
                    }
                });
            });

            //code for order status on change
            $(document).on("change", "input[name=\"order-status\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();
                let payment_method = [];
                let delivery_status = [];
                let order_status=0;

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                if($('#order-status-filter').is(':checked'))
                {
                    order_status = 1;
                    console.log("Checkbox value:", order_status);
                }

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'adminSortFilterOrders.php',
                    type: 'POST',
                    data: { payment_method: payment_method, delivery_status: delivery_status, sort_by: sort_by, order_status: order_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, order_status, from_date, to_date);
                        $('.product-item-container').html(data);
                    }
                });
            });


        //  ****************************************************
        //      code for sorting the orders in admin pannel
        //  ****************************************************
            $(document).on("change", "input[name=\"sort-by\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();

                let order_status=0;

                if($('#order-status-filter').is(':checked'))
                {
                    order_status = 1;
                    console.log("Checkbox value:", order_status);
                }

                let payment_method = [];
                let delivery_status = [];


                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'adminSortFilterOrders.php',
                    type: 'POST',
                    data: { sort_by: sort_by, payment_method: payment_method, delivery_status: delivery_status, order_status: order_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, order_status, from_date, to_date);

                        $('.product-item-container').html(data);
                    }
                });
            });

        //  ****************************************************
        //      code  for exporting orders in excel
        //  ****************************************************
        $(document).on("click", ".export-button", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();
                let timestamp = new Date().getTime();

                let payment_method = [];
                let delivery_status = [];

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'adminExportOrdersInExcel.php',
                    type: 'POST',
                    data: { sort_by: sort_by, payment_method: payment_method, delivery_status: delivery_status, from_date: from_date, to_date: to_date}, 
                    success: function(data, status, xhr) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by);
                        let filename = "Orders_"+timestamp+".xls"; // Specify the desired filename here
                        let contentType = xhr.getResponseHeader('Content-Type');

                        // Create a Blob from the response data
                        let blob = new Blob([data], { type: contentType });

                        // Create a temporary anchor element and download the file
                        let link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;
                        link.click();

                    }
                });
            });

        //  ****************************************************
        //      code  for download the invoice in pdf format
        //  ****************************************************
        $(document).on("click", ".get-invoice-btn", function(e){
            let order_id=$(this).data('order-id');
            console.log(order_id);
            var form = $('<form>', {
            method: 'POST',
            action: 'adminDownloadInvoice.php',
            target: '_blank' // Open the PDF in a new tab/window
            });

            // Add hidden input fields for each data item
            form.append($('<input>', {
            type: 'hidden',
            name: 'order_id',
            value: order_id
            }));
            // Append the form to the document and submit it
            form.appendTo(document.body).submit();
        });

        //******************************************************
        //      code for date range picker
        //******************************************************

        $(document).on('click', '#get-by-date-range', function(e){
            let from_date=$('#from').val();
            let to_date=$('#to').val();

            if(from_date=='')
            {
                alert("Please select from date");
            }
            else if(to_date=='')
            {
                alert("Please select to date");
            }
            else
            {
                // console.log(from_date, to_date);
                let sort_by=$('input[name="sort-by"]:checked').val();
                let payment_method = [];
                let delivery_status = [];
                let order_status=0;
    
                if($('#order-status-filter').is(':checked'))
                {
                    order_status = 1;
                    console.log("Checkbox value:", order_status);
                }
    
                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });
    
                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });
    
                $.ajax({
                    url: 'adminSortFilterOrders.php',
                    type: 'POST',
                    data: { payment_method: payment_method, delivery_status: delivery_status, sort_by: sort_by, order_status: order_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, order_status, from_date, to_date);
                        $('.product-item-container').html(data);
                    }
                });
            }
        });

        // code for confirming order as admin 
        $(document).on("click", "#cancel-order-admin", function(e){
            if(confirm('Do you Really want cancel order'))
            {
                let order_id=$(this).data('order-id');
                console.log(order_id);
                $.ajax({
                    url: "adminCancelOrder.php",
                    type: "POST",
                    data: {order_id: order_id},
                    success: function(data) {
                        if(data==1)
                        {
                            console.log('order canceled');
                            $('.admin-operation-container').hide();
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

        // code for confirming order as admin 
        $(document).on("click", "#confirm-order-admin", function(e){
            if(confirm('Do you Really want Confirm order'))
            {
                let order_id=$(this).data('order-id');
                console.log(order_id);
                $.ajax({
                    url: "adminConfirmOrder.php",
                    type: "POST",
                    data: {order_id: order_id},
                    success: function(data) {
                        if(data==1)
                        {
                            console.log('order canceled');
                            $('.admin-operation-container').hide();
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



        //  ****************************************************
        //      from here i will write only function code
        //  ****************************************************

            // load product by deafult on home page 
            function loadProduct()
            {
                $.ajax({
                    url: "adminLoadProduct.php",
                    type: "POST",
                    data: {},
                    success: function(data){
                        $(".middle").html(data);
                    }
                });
            }

            //load category on category tab
            function loadCategory()
            {
                $.ajax({
                    url: "adminLoadCategory.php",
                    type: "POST",
                    data: {},
                    success: function(data){
                        $(".middle").html(data);
                    }
                });
            }


            //load sub-category page on sub-category tab
            function loadSubCategoryPage()
            {

                $.ajax({
                    url: "adminLoadSubCategoryPage.php",
                    type: "POST",
                    data: {},
                    success: function(data){
                        $(".middle").html(data);
                        let category_id = $("#category-id-of-subcategory-page").val();
                        loadSubCategory(category_id);
                    }
                });
            }

            //load sub-category table
            function loadSubCategory(category_id)
            {
                console.log(category_id);
                $.ajax({
                    url: "adminLoadSubCategory.php",
                    type: "POST",
                    data: {category_id: category_id},
                    success: function(data){
                        $(".sub-category-container").html(data);
                    }
                });
            }

            //load orders table
            function loadOrders()
            {
                $.ajax({
                    url: "adminLoadOrders.php",
                    type: "POST",
                    data: {},
                    success: function(data){
                        $(".middle").html(data);
                    }
                });
            }


        });

    </script>
</body>
</html>