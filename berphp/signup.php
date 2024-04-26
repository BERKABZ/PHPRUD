<?php
include("dbconnect.php"); 

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $check_query = "SELECT * FROM porma WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo '<script>
                window.location.href = "index2.php";
                alert("Username already exists. Please choose a different one.");
              </script>';
        exit();
    }


    $insert_query = "INSERT INTO porma  (firstname, lastname, age, address, username, password) VALUES ('$firstname', '$lastname', '$age', '$address', '$username', '$password')";
    if (mysqli_query($conn, $insert_query)) {
        header("Location: welcome.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }
}
?>
