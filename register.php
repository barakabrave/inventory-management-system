<?php
$servername = "localhost";  // Change to your server name if different
$username = "root";         // Change to your MySQL username
$password = "";             // Change to your MySQL password if set
$dbname = "inventory";  // Change to your database name

// Create connection
try{
    $conn = new PDO("mysql:host-$servername;dbname-inventory", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "connected successfully";
}catch(\Exception $e){

}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO login (f_name, l_name, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
}


// Close connection
$conn->close();
?>
