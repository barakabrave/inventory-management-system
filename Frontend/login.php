<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS - Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="maindiv">
<div class="transbox">
<div class="divheader">
<h1 class="h1ims"><a href="homepage.html">IMS</a></h1>
<p class="h2ims">INVENTORY MANAGEMENT SYSTEM</p>
</div>
<div class="div-form-login"> 
    <?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and process login
    handleLogin();
}
?> 
    <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="Username" style="color:rgb(247, 95, 121); font-weight: bold;">USERNAME</label><br><br>
     <input type="text" placeholder="username" class="txt-username" name="username" size="30px" required><br><br>
     <label for="password" style="color:rgb(247, 95, 121); font-weight: bold;">PASSWORD</label><br><br>
     <input type="password" placeholder="password" class="txt-password" name="password" size="30px" required><br><br><br>
 <input type="submit" value="Login" class="submit-btn">
 <p style="color:rgb(228, 225, 225); font-weight: bold;"> Are you new to this website? <a href="registration.php">Click here to register</a></p>
     </form> 
     <?php
// Function to handle login logic
function handleLogin() {
    // Assuming you have a database connection
    $conn = new mysqli("localhost", "root","", "inventory");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Query to check user credentials
    $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Check if a matching user is found
    if ($result->num_rows > 0) {
        header("Location: homepage.php");
        echo "Login successful!";
        exit();
    } else {
        echo "Invalid username or password.";
    }

    // Close database connection
    $conn->close();
}
?>

    </div>
    </div>
</div>
</body>
</html>