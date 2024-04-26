<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT firstname, lastname, username, password FROM porma WHERE username = '$username'";
$result = $conn->query($sql);

$user_data = array();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_data['firstname'] = $row["firstname"];
    $user_data['lastname'] = $row["lastname"];
    $user_data['username'] = $row["username"];
    // Note: Avoid displaying passwords directly on the webpage for security reasons.
    $user_data['password'] = "********"; // Display a placeholder for password
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="account.css">
    <title>Account</title>

</head>
<body>
<div class="bck">
    <a href="dash.php" ><img src="accountB.png"></a>
</div>

    <div class="container">
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <tr>
                <td><?php echo $user_data['firstname']; ?></td>
                <td><?php echo $user_data['lastname']; ?></td>
                <td><?php echo $user_data['username']; ?></td>
                <td><?php echo $user_data['password']; ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
