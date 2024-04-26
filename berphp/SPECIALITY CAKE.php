<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SPECIALITYCAKE.css">
    <title>Document</title>
    <style> 
 h1 {
    text-align: center;
 }
</style>
</head>
<body>
    <div class="bck">
        <a href="product.php"> <img src="../SpecialityImage/back-fotor-bg-remover-2024040593459.png"></a>
    </div>
    <h1>SPECIALITY CAKES</h1>
   
        <!-- Form for adding new product -->
        <form>
        
            <input type="text" name="productname" placeholder="Product Name">
            <input type="text" name="id" placeholder="Product ID">
            <input type="number" name="price" placeholder="Price">
            <input type="number" name="quantity" placeholder="Quantity">
            <input type="text" name="update" placeholder="Update">
            <input type="text" name="delete" placeholder="Delete">
          
        </form>

        <?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "bsit2"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $id = $productname = $price = $quantity = "";

        // Validate product name
        if (empty($_POST["productname"])) {
            $productnameErr = "Product name is required";
        } else {
            $productname = test_input($_POST["productname"]);
        }

        // Validate price
        if (empty($_POST["price"])) {
            $priceErr = "Price is required";
        } else {
            $price = test_input($_POST["price"]);
        }

        // Validate quantity
        if (empty($_POST["quantity"])) {
            $quantityErr = "Quantity is required";
        } else {
            $quantity = test_input($_POST["quantity"]);
        }

        // Insert new product into the database if all fields are valid
        if (!empty($productname) && $price !== '' && $quantity !== '') {
            // Escape special characters to prevent SQL injection
            $productname = mysqli_real_escape_string($conn, $productname);
            $price = mysqli_real_escape_string($conn, $price);
            $quantity = mysqli_real_escape_string($conn, $quantity);

            // If id is included in the form submission
            if (isset($_POST['id'])) {
                $id = mysqli_real_escape_string($conn, $_POST['id']);
            }

            // Construct SQL query to insert the new product
            $sql = "INSERT INTO products (id, productname, price, quantity) VALUES ('$id', '$productname', '$price', '$quantity')";

            // Execute the SQL query
            if ($conn->query($sql) === TRUE) {
                echo "New product added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Product name, price, and quantity cannot be empty";
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Read operation - Retrieve and display existing products
$sql = "SELECT id, productname, price, quantity FROM products";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["productname"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        // Update button
        echo "<td><a href='update.php?id=" . $row["id"] . "' class='btn btn-success'>Update</a></td>";
        // Delete button
        echo "<td><a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>

