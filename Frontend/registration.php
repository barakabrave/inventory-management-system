<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration-form</title>
    <link href="registration.css" rel="stylesheet">
</head>
<body >
    <div class="main-div">
        <h1 class="h1ims"><a href="homepage.html">IMS</a></h1>
        <p class="h2ims">INVENTORY MANAGEMENT SYSTEM</p>
    </div>
    <div class="main">
        <div class="container">
            <div class="div-information">
                <h2>INFORMATION</h2>
                <p class="p-information">The registration form on our website gathers essential information to create personalized accounts. 
                   <br><br> Providing details like name, email, and password ensures a seamless and secure user experience. Join us today! </p>
            <button class="btn-have-account"><a href="login.php"><b>Have An Account</b></a></button>
                </div>
            <div class="div-form">
                <form action="" method="post">
                    <h2>REGISTER FORM</h2>
                    <table>
                        <tr>
                            <td>
                                <label>First Name</label><br>
                                <input name="firstname" type="text" required>
                            </td>
                            <td>
                                <label>Last Name</label><br>
                                <input name="lastname" type="text" required>
                            </td>
                        </tr>
                        <tr>
        
                    </table><br>
                    <table>
                                <label>Username</label><br>
                                <input name="username" type="text" style="width: 350px;" required><br><br>
                        <label>Your Email</label><br>
                    <input name="email" type="text" class="txt-email" required>
                    </table><br>
                    
                    <table>
                        
                        <tr>
                            <td>
                                <label>Password</label><br>
                                <input name="password" type="password" required>
                            </td>
                            <td>
                                <label> Confirm Password</label><br>
                                <input name="confirm_password" type="password" required>
                            </td> 
                        </tr>
                    </table><br><br>
                    <input name="terms" type="checkbox" id="checkbox" onchange="enableSubmit()">I agree to the <a href="">Terms and Conditions</a><br>
                    <br><input name="submit" type="submit" value="Register" id="btn-register" class="disabled" disabled>
                    <p>Do you already have an account?<a href="login.php"> Click here to Login</a></p>    
                </form>
                <script>
    function enableSubmit() {
        var agreeCheckbox = document.getElementById("checkbox");
        var submitButton = document.getElementById("btn-register");

        // Enable/disable the submit button based on the checkbox state
        submitButton.disabled = !agreeCheckbox.checked;

        // Add or remove the 'disabled' class based on the checkbox state
        if (agreeCheckbox.checked) {
            submitButton.classList.remove("disabled");
        } else {
            submitButton.classList.add("disabled");
        }
    }
</script>
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
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password= $conn->real_escape_string($_POST["confirm_password"]);
    if ($password === $confirm_password){
    $sql = "INSERT INTO login (f_name, l_name, username, email, password) VALUES ('$firstname', '$lastname', '$username','$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else{
    echo "Password do not match";
    $conn->close();
    return;
}}


// Close connection
$conn->close();
?>

            </div>
         </div>
    </div>  
</body>
</html>