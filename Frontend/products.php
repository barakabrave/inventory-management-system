<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products.css">
    <title>IMS - Products</title>
</head>
<body>
    <div class="main-div">
    <div class="navbar">
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="registration.php">Registration</a></li>
            <li><a class="active"  href="products.php">Products</a></li>
        </ul>
    </div>
    <div class="divheader">
        <h1 class="h1ims"><a href="homepage.html">IMS</a></h1>
        <p class="h2ims">INVENTORY MANAGEMENT SYSTEM</p>
    </div>
        <div class="div-form-login">
            <table style='padding-top:30px'>
                <tr>
            <td><form action="" method="post" class='form-product'>
                <label for="product-id" style="color:rgb(247, 95, 121); font-weight: bold;"> PRODUCT ID&emsp;&emsp;&emsp;&emsp;&emsp;</label>
                <input type="text" name="product_id" placeholder="Product Id" class="product-id" size="40px" required ><br><br>
               <label for="product-name" style="color:rgb(247, 95, 121); font-weight: bold;">PRODUCT NAME&emsp;&emsp;&emsp;</label>
               <input type="text" name="product_name" placeholder="Product Name" class="product-name" size="40px" required ><br><br>
               <label for="product-quantity" style="color:rgb(247, 95, 121); font-weight: bold;">PRODUCT QUANTITY&emsp;</label>
               <input type="text" name="quantity" placeholder="Product Quantity" class="product-quantity" size="40px" required ><br><br>
                <input type="submit" value="Submit" class="submit-btn">
            </form></td>
</tr>
</table>
            <?php
$servername = "localhost";  // Change to your server name if different
$username = "root";         // Change to your MySQL username
$password = "";             // Change to your MySQL password if set
$dbname = "inventory";  // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $conn->real_escape_string($_POST['product_id']);
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
   
    $sql = "INSERT INTO product (product_id, product_name, quantity) VALUES ('$product_id', '$product_name', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>
        </div>
        <?php
        // Get starting point for fetching data
$start = isset($_GET['start']) ? $_GET['start'] : 0;
$limit = 3; // Number of items to fetch at a time
        // SQL query to retrieve data from the product table
$sql1 = "SELECT product_id, product_name, quantity FROM product";
$result = $conn->query($sql1);

// Check if there are any results
if ($result->num_rows > 0) {
    echo "<div class='div-products-table'>
    <h2>PRODUCTS</h2>
    <table border='1' class='products-table'>
        <tr>
            <th style='color:rgb(247, 95, 121);'>Product ID</th>
            <th style='color:rgb(247, 95, 121);'>Product Name</th>
            <th style='color:rgb(247, 95, 121);'>Quantity</th>
        </tr>";

// Output data of each row
while ($row = $result->fetch_assoc()) {
echo "<tr>
        <td>" . $row["product_id"] . "</td>
        <td>" . $row["product_name"] . "</td>
        <td>" . $row["quantity"] . "</td>
    </tr>";
}

echo "</table>
</div>";
// Add a button to load more data
    echo "<div id='load-more-container'></div>";
    echo "<button id='load-more-button' onclick='loadMore($start, $limit)'>Load More</button>";

} else {
    echo "<div style='margin: 20px;'>No results found</div>";
}
// Close connection
$conn->close();
?>

    </div>
    <div class="footer">
        <a href="">Contact</a>
        <a href="">Download</a>
        <a href="">Press</a>
        <a href="">Email</a>
        <a href="">Support</a>
        <a href="">Privacy Policy</a>
    </div> 
    <script>
    // JavaScript function to load more data using AJAX
    function loadMore(start, limit) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("load-more-container").innerHTML += this.responseText;
            }
        };
        xhttp.open("GET", "load-more.php?start=" + (start + limit), true);
        xhttp.send();
    }
</script>   
</body>
</html>