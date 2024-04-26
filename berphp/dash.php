<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT firstname, lastname FROM porma WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];

} 
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head class="header">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dash.css">
    <title>Document</title>
    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header"></div>
    <div class="side"></div>

    <div class="dash">
        <div class="first">
            <img src="dash.webp">
            <h2>AMA <br> ADMIN</h2>
        </div> 
        <div class="ubos"> 
            <div class="lahi">
                <h1 class="me">Dashboard</h1>
            </div>
            <a href="Product.php"><h1 class="me">Products</h1></a>
            <a href="sales.php"> <h1 class="me">Sales</h1></a>
            <a href="accounts.php"> <h1 class="me">Accounts</h1></a>
        </div>
    </div>

    <button class="btn"><a href="index.php">Sign Out</a></button>

    <p class="p">8 <br> Weekly New Menu's</p>
    <p class="pp">10,342<br> Today's Total Income</p>
    <p class="ppp">16 <br> Today's Total Order</p>
    <p class="pppp">16 <br> Total Order Received</p>

    <div class="box1">
        <p>Best Sale</p>
        <h1 class="h1">Chocolate Dedication Cake</h1>
        <img class="image" src="dassh.webp">
        <h1 class="h11">EVERDAY BUNDLE 1</h1>
        <img class="image1" src="dasssh.webp">
    </div>

    <img class="imgg" src="dash.png">

    <p class="wa">Day1 Day2 Day3 Day4 Day5 Day6 Day7</p>
    <p class="wa1">6000 </p>
    <p class="wa2">4000 </p>
    <p class="wa3"> 2000  </p>
    <p class="wa4"> 0</p>

    <div class="m1">
        <h1>Inventory Management System</h1>    
    </div> 
</body>
</html>
