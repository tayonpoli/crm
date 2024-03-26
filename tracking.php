<?php
include 'config.php';

$order_id = $_GET['order_id'];

if(isset($_GET['shipping_status'])){
    $shipping_status = $_GET['shipping_status'];
} else {
    $shipping_status_query = mysqli_query($conn, "SELECT shipping_status FROM `orders` WHERE id = '$order_id'") or die('query failed');
    $fetch_shipping_status = mysqli_fetch_assoc($shipping_status_query);
    $shipping_status = $fetch_shipping_status['shipping_status'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking order</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
@font-face {
    font-family: pop;
    src: url(./Fonts/Poppins-Medium.ttf);
}

.main{
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: pop;
    flex-direction: column;
}
.head{
    text-align: center;
}
.head_1{
    font-size: 30px;
    font-weight: 600;
    color: #333;
}
.head_1 span{
    color: #ff4732;
}
.head_2{
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-top: 3px;
}
ul{
    display: flex;
    margin-top: 80px;
}
ul li{
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}
ul li .icon{
    font-size: 35px;
    color: #ff4732;
    margin: 0 60px;
}
ul li .text{
    font-size: 14px;
    font-weight: 600;
    color: #ff4732;
}

/* Progress Div Css  */

ul li .progress{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(68, 68, 68, 0.781);
    margin: 14px 0;
    display: grid;
    place-items: center;
    color: #fff;
    position: relative;
    cursor: pointer;
}
.progress::after{
    content: " ";
    position: absolute;
    width: 125px;
    height: 5px;
    background-color: rgba(68, 68, 68, 0.781);
    right: 30px;
}
.one::after{
    width: 0;
    height: 0;
}
ul li .progress .uil{
    display: none;
}
ul li .progress p{
    font-size: 13px;
}

/* Active Css  */

ul li .active{
    background-color: #ff4732;
    display: grid;
    place-items: center;
}
li .active::after{
    background-color: #ff4732;
}
ul li .active p{
    display: none;
}
ul li .active .uil{
    font-size: 20px;
    display: flex;
}

/* Responsive Css  */

@media (max-width: 980px) {
    ul{
        flex-direction: column;
    }
    ul li{
        flex-direction: row;
    }
    ul li .progress{
        margin: 0 30px;
    }
    .progress::after{
        width: 5px;
        height: 55px;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: -1;
    }
    .one::after{
        height: 0;
    }
    ul li .icon{
        margin: 15px 0;
    }
}

@media (max-width:600px) {
    .head .head_1{
        font-size: 24px;
    }
    .head .head_2{
        font-size: 16px;
    }
}


    </style>
</head>
<body>
    <div class="main">

        <div class="head">
            <p class="head_1">Your Order Process </p>
           
        </div>

        <ul>
            <li>
                <i class="icon uil uil-capture"></i>
                <div class="progress one">
                    <p>1</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Pending</p>
            </li>
            <li>
                <i class="icon uil uil-clipboard-notes"></i>
                

                <div class="progress two">
                    <p>2</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Order Processes</p>
            </li>
            <li>
                <i class="icon uil uil-exchange"></i>
                <div class="progress three">
                    <p>3</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Order Complete</p>
            </li>
            
        </ul>

    </div>

    <script src="main.js"></script>
    <script>
const progressbarOne = document.querySelector(".one");
const progressbarTwo = document.querySelector(".two");
const progressbarThree = document.querySelector(".three");

// Get the order ID and shipping status from the URL.
const urlParams = new URLSearchParams(window.location.search);
const orderId = urlParams.get('order_id');
const shippingStatus = urlParams.get('shipping_status');

// Update progress bar based on shipping status.
if (shippingStatus === "pending") {
  progressbarOne.classList.add("active");
} else if (shippingStatus === "process") {
  progressbarOne.classList.add("active");
  progressbarTwo.classList.add("active");
} else if (shippingStatus === "completed") {
  progressbarOne.classList.add("active");
  progressbarTwo.classList.add("active");
  progressbarThree.classList.add("active");
}
</script>


  
</body>
</html>
