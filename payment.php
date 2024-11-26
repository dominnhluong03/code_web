<?php
    session_start();
    
    function isLoggedIn() {
        return isset($_SESSION["email"]);
    }
    
    if (isLoggedIn()) {
        include("./menu_login.php");
        if (isset($_GET["act"]) && $_GET["act"] == "logout") {
            session_destroy();
            // Ngăn chặn trình duyệt lưu trữ cache
            header("Cache-Control: no-cache, must-revalidate");
    
            // Chuyển hướng đến trang logout
            echo '<script>window.location.href = "screen_logout.php";</script>';
            exit();
        }
    }
    else{
        include('./menu_logout.php');
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Thanh Toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .cart-top-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cart-top {
            height: 2px;
            width: 70%;
            background-color: #dddddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 50px 0 100px;
        }

        .cart-top-item {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #dddddd;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
        }

        .cart-top-item i {
            color: #dddddd;
        }

        .cart-top-cart i {
            color: #0DB7EA;
        }
        

        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .payment-options, .summary {
            flex: 1;
            background-color: #f8f8f8;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .payment-options h2,
        .summary h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .payment-options label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: #555;
        }

        .payment-options input[type="radio"] {
            margin-right: 10px;
        }

        .payment-options img {
            vertical-align: middle;
            margin-right: 5px;
        }

        .summary .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary .total-row span {
            font-weight: bold;
            font-size: 16px;
        }

        .summary .discount {
            color: red;
        }

        

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
        <div class="fluid-container">
        <!-- cart -->
        <div class="layoutPage-cart" style="margin-top: 150px;">
            <div class="heading-page">
                <div class="header-page">
                    <h1 style="margin-left: 40%;">Thanh toán</h1>
                </div>
            </div>    
        </div>
    </div>
    <div class="container">
    <div class="cart-top-wrap">
                            <div class="cart-top">
                                <div class="cart-top-cart cart-top-item">
                                <i class="bi bi-cart3 cart-top-item"></i>
                                </div>
                                <div class="cart-top-cart">
                                <i class="bi bi-geo-alt cart-top-item"></i>
                                </div>
                                <div class="cart-top-cart">
                                <i class="bi bi-wallet2 cart-top-item"></i>
                                </div>
                            </div>
                    </div>
    </div>
    <div class="container">
        <div class="main-content">
            <!-- Phần bên trái: Phương thức -->
            <div class="payment-options">
                <h2>Phương thức giao hàng</h2>
                <label>
                    <input type="radio" name="shipping" checked>
                    Giao hàng chuyển phát nhanh <br>
                    <small>Chuyển hàng tới địa chỉ khách hàng.</small>
                </label>

                <h2>Phương thức thanh toán</h2>
                <label>
                    <input type="radio" name="payment">Thanh toán bằng thẻ tín dụng (OnePay) 
                    <br>
                    <img style= "width: 50px; height: 30px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCKq2O95GbyMGl_4zW2L7RoBWCX4RZCdCBgA&s" alt="Visa" width="40"> 
                </label>
                <label>
                    <input type="radio" name="payment">Thanh toán bằng thẻ ATM (OnePay)
                    <br>
                    <img style= "width: 50px; height: 30px;" src="https://cafefcdn.com/zoom/700_438/2019/6/25/logo-bankpngffffff-1561427849156344392040-crop-1561427856887663294599.png" alt="ATM" width="40"> 
                </label>
                <label>
                    <input type="radio" name="payment">Thanh toán MoMo
                    <br>
                    <img style= "width: 50px; height: 30px;" src="https://cdn-media.sforum.vn/storage/app/media/vi-momo.jpg" alt="MoMo" width="40"> 
                </label>
                <label>
                    <input type="radio" name="payment" checked>
                    Thu tiền tận nơi
                </label>
            </div>

            <!-- Phần bên phải: Chi tiết đơn hàng -->
            <div class="summary">
                <h2>Chi tiết đơn hàng</h2>
                <div class="total-row">
                    <span>Tên sản phẩm</span>
                    <span>Áo sơ mi trắng Bamboo MS 16E2975</span>
                </div>
                <div class="total-row">
                    <span>Giảm giá</span>
                    <span class="discount">399.000đ</span>
                </div>
                <div class="total-row">
                    <span>Tổng tiền hàng</span>
                    <span>399.000đ</span>
                </div>
                <div class="total-row">
                    <span>Phí giao hàng</span>
                    <span>38.000đ</span>
                </div>
                <div class="total-row">
                    <span>Tiền thanh toán</span>
                    <span>437.000đ</span>
                </div>
            </div>
        </div>

        <div class="btn-container" style="text-align: center;
            margin-top: 20px;">
            <button class="btn" style="padding: 10px 20px; background-color: #007bff; color: #fff;border: none;border-radius: 5px;cursor: pointer;font-size: 16px;">Thanh toán</button>
        </div>
    </div>
</body>
</html>
<?php
    include("./footer.php")
?>