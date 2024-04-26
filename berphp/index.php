<?php
session_start();
include("dbconnect.php");

$servername = "localhost";
$dbusername = "root"; // Replace with your actual database username
$dbpassword = ""; // Replace with your actual database password
$dbname = "bsit2"; // Replace 'bsit2' with your actual database name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hash the password (using md5 for now, but bcrypt or Argon2 is recommended)
        $hashed_password = md5($password);

        // Check credentials against database using prepared statements
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM porma WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();   

       
     

        if ($result->num_rows == 1) {
            // If credentials are correct, set session variable and redirect to welcome page
            $_SESSION['username'] = $username;
            header("Location: dash.php");
            exit();
        } else {
            // If credentials are incorrect, display error message
            $error = "Invalid username or password!";
        }

        // Close the prepared statement and the database connection
       
    } else {
        // If username or password is empty, display error message
        $error = "Please enter both username and password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Login</title>
</head>
<body>
    
    <div class="side">
        <div class="whole">
            <img class="img2" src="indexR.jpg">
            <h1>ADMIN</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input class="one" type="text" name="username" placeholder="Username"><br>
                <input class="two" type="password" name="password" placeholder="Password"><br>
                <button type="submit" class="btn">Login</button>
            </form>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <a class="forgot" href="Resetpass1.php">Forgot Password?</a>
        </div>
        <img class="img1" src="indexL.png">
        <img class="img3" src="indexP.png">
        
    </div>
</body>
</html>
