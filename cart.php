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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Giỏ hàng của bạn</title>
    <link rel="shortcut icon" href="/image/Logo/main-logo.png" type="image/x-icon">
    <style>
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

        /* Adjust cart-content layout */
        .cart-content {
            display: flex;
            flex-wrap: wrap; /* Ensure it adapts on smaller screens */
            justify-content: space-between;
            gap: 16px; /* Add spacing between left and right parts */
        }

        .cart-content-left {
            flex: 2;
            padding-right: 12px;
            min-width: 60%; /* Ensure it doesn't shrink too much */
        }

        .cart-content-left table {
            width: 100%;
            text-align: center;
        }

        .cart-content-left table th {
            padding-bottom: 30px;
            font-family: var(--main-text-font);
            font-size: 12px;
            text-transform: uppercase;
            color: #333;
            border-collapse: collapse;
            border-bottom: 2px solid #dddddd;
        }

        .cart-content-left table p {
            font-size: 14px; /* Fix too small font size */
            font-family: var(--main-text-font);
            color: #333;
        }

        .cart-content-left table input {
            width: 40px; /* Increase width for better usability */
            text-align: center; /* Center the input text */
        }

        .cart-content-left table span {
            display: block;
            width: 20px;
            height: 20px;
            border: 1px solid #dddddd;
            cursor: pointer;
        }

        .cart-content-left td:first-child img {
            width: 130px;
            padding-top: 20px;
        }

        .cart-content-left table td {
            padding: 20px 0;
            border-bottom: 2px solid #dddddd;
        }

        .cart-content-left td:nth-child(2) {
            max-width: 130px;
        }

        .cart-content-left td:nth-child(3) img {
            width: 30px;
        }

        /* Style for cart-content-right */
        .cart-content-right {
            flex: 1;
            min-width: 35%; /* Ensure it adapts on smaller screens */
        }

        .cart-content-right table {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        .cart-content-right table th {
            font-family: var(--main-text-font);
            font-size: 14px;
            text-transform: uppercase;
            color: #333;
            padding-bottom: 20px;
        }

        .cart-content-right table td {
            padding: 10px 0;
        }

        .cart-content-right-text {
            margin-top: 20px;
            font-family: var(--main-text-font);
            font-size: 12px;
            color: #333;
        }

        .cart-content-right-button {
            display: flex;
            gap: 16px;
            margin-top: 20px;
        }

        .cart-content-right-button button {
            padding: 10px 20px;
            border: none;
            background-color: #0DB7EA;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }

        .cart-content-right-button button:hover {
            background-color: #0a92c1;
        }
    </style>
</head>

<body>
    <div class="fluid-container">
        <!-- cart -->
        <div class="layoutPage-cart" style="margin-top: 150px;">
            <div class="heading-page">
                <div class="header-page">
                    <h1 style="margin-left: 40%;">Giỏ hàng của bạn</h1>
                    <div class="warning" >
                        <p style="margin-left: 20%;">Sản phẩm mua được phép đổi trong vòng 7 ngày (tính từ ngày quý khách nhận được hàng). Chúng tôi không chấp nhận hủy đơn hàng.</p>
                    </div>
                </div>
            </div>    
        </div>
    </div>
    <!-- cart -->
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
                    <div class="cart-content row">
                        <div class="cart-content-left">
                            <table>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>size</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Xoá</th>
                                </tr>
                                <tr>
                                    <td> <img src="image/sp_index/product4_1.webp" alt=""></td>
                                    <td>ÁO POLO</td>
                                    <td>
                                        <p>L</p>
                                    </td>
                                    <td>
                                        <input type="number" value="1" min="1">
                                    </td>
                                    <td>
                                        <p>299.000 <sup>đ</sup></p>
                                    </td>
                                    <td>
                                        <span>X</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <img src="image/sp_index/product4_1.webp" alt=""></td>
                                    <td>ÁO POLO</td>
                                    <td>
                                        <p>L</p>
                                    </td>
                                    <td>
                                        <input type="number" value="1" min="1">
                                    </td>
                                    <td>
                                        <p>299.000 <sup>đ</sup></p>
                                    </td>
                                    <td>
                                        <span>X</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="cart-content-right">
                            <table>
                                <tr>
                                    <th colspan= "2">Tổng giỏ hàng</th>
                                </tr>
                                <tr>
                                    <td>Tổng sản phẩm</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <td>
                                        <p>299.000 <sub>đ</sub></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tạm tính</td>
                                    <td>
                                        <p>299.000 <sub>đ</sub></p>
                                    </td>
                                </tr>
                            </table>
                            <div class="cart-content-right-text">
                                <p>Bạn sẽ được miễn phí ship khi đơn hàng của bạn có tổng giá trị trên 2.000.000</p>
                                <p>Mua trên 131.000đ để được miễn phí ship</p>
                            </div>
                            <div class="cart-content-right-button">
                                <button>Tiếp tục mua sắm</button>
                                <button>Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
</body>

</html>

<?php
    include("./footer.php")
?>
