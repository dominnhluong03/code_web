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
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giao hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 1000px;
            background-color: #f8f8f8;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
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

        .delivery-form {
            display: flex;
            gap: 20px;
        }

        .delivery-left {
            flex: 2;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .delivery-right {
            flex: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .delivery-left h3 {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .delivery-left input[type="text"],
        .delivery-left select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .delivery-right table {
            width: 100%;
            border-collapse: collapse;
        }

        .delivery-right table th,
        .delivery-right table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .delivery-right table th {
            text-transform: uppercase;
            font-size: 14px;
            color: #333;
        }

        .delivery-right table td:last-child {
            text-align: right;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0DB7EA;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #0a92c1;
        }

        .back-link {
            display: inline-block;
            margin-top: 10px;
            font-size: 14px;
            color: #0DB7EA;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="fluid-container">
        <!-- cart -->
        <div class="layoutPage-cart" style="margin-top: 150px;">
            <div class="heading-page">
                <div class="header-page">
                    <h1 style="margin-left: 40%;">Thông tin Địa chỉ</h1>
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

        <div class="delivery-form">
            <div class="delivery-left">
                <h3>Vui lòng chọn địa chỉ giao hàng</h3>

                <input type="text" placeholder="Họ tên *">
                <input type="text" placeholder="Điện thoại *">
                <label for="tinh">Tỉnh/Thành phố:</label>
                <select name="" id="city">
                        <option value="">Tỉnh/Tp</option>
                </select>

                <label for="huyen">Quận/Huyện:</label>
                <select name="" id="district">
                        <option value="">Quận/huyện</option>
                </select>

                <label for="xa">Phường/Xã:</label>
                <select name="" id="ward">
                        <option value="">Phường/xã</option>
                </select>
                <input type="text" placeholder="Địa chỉ *">
                <a href="#" class="back-link"><< Quay lại giỏ hàng</a>
                <a href="#" class="btn">Thanh toán và giao hàng</a>
            </div>
            <div class="delivery-right">
                <h3>Tên sản phẩm</h3>
                <table>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giảm giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                    <tr>
                        <td>Áo polo kẻ ngang MS 57E2940</td>
                        <td>-30%</td>
                        <td>1</td>
                        <td>483.000đ</td>
                    </tr>
                    <tr>
                        <td colspan="3">Tổng tiền hàng</td>
                        <td>690.000đ</td>
                    </tr>
                    <tr>
                        <td colspan="3">Tạm tính</td>
                        <td>483.000đ</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script>
        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data, "city");
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district");
                });
        }
        var callApiWard = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.wards, "ward");
                });
        }


        var renderData = (array, select) => {
            let row = ' <option disable value="">Chọn</option>';
            array.forEach(element => {
                row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }


        $("#city").change(() => {
            callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
        
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
        
        });
        $("#ward").change(() => {
        
        })
    </script>
</body>
</html>
<?php
    include("./footer.php")
?>

