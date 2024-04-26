<?php
session_start();
include("dbconnect.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

// Include the database connection file
include("dbconnect.php");

// Retrieve the username from the session
$username = $_SESSION['username'];

// Query to retrieve user information
$sql = "SELECT firstname, lastname FROM porma WHERE username = '$username'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch user data
    $row = $result->fetch_assoc();
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
} else {
    // Redirect to dashboard if user data not found
    header("Location: dash.php");
    exit();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="product.css">
</head>
<body>

<div class="bck">
        <a href="dash.php"> <img src="productB.png"></a>
     </div>  
       <h1>CATEGORIES</h1>
       <div class="box">
    <a style="color: black; margin-top: 70px; background-color: rgb(201, 36, 36); text-align: center; height: 200px; width: 30%; text-decoration: underline; font-size: 50px; border: 4px solid black; display: flex; align-items: center;" href="SPECIALITY CAKE.php">SPECIALITY CAKE</a>
    <a style="color: black; margin-top: 70px; background-color: rgb(201, 36, 36); text-align: center; height: 200px; width: 29%; text-decoration: underline; font-size: 50px; border: 4px solid black; display: flex; align-items: center;" href="DedicationCategory.php">DEDICATION CAKE</a>
    <a style="color: black; margin-top: 70px; background-color: rgb(201, 36, 36); text-align: center; height: 200px; width: 20%; text-decoration: underline; font-size: 50px; border: 4px solid black; display: flex; align-items: center; justify-content: center;" href="RollCategory.php">ROLL CAKE</a>
</div>

<div class="box1" style="display: flex; margin-left: 50px;">
    <a class="tulo" href="PastriesCategory.php" style="color: black; margin-top: 70px; background-color: rgb(201, 36, 36); text-align: center; height: 200px; width: 50%; text-decoration: underline; font-size: 50px; border: 4px solid black; display: flex; align-items: center; justify-content: center; margin-left: 20%;">PASTRIES, BREAD & DELICACIES</a>
    <a class="bundle" href="BundleCategory.php" style="color: black; margin-top: 70px; background-color: rgb(201, 36, 36); text-align: center; height: 200px; width: 50%; text-decoration: underline; font-size: 50px; border: 4px solid black; display: flex; align-items: center; justify-content: center; margin-right: 10%;">EVERYDAY BUNDLE</a>
</div>





</body>
</html>
