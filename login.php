<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($hostname, $username, $password, $dbname);

function generateOTP() {
    return mt_rand(100000, 999999);
}

function sendOTPByEmail($email, $otp) {
    $to = $email;
    $subject = "Your OTP for Login Verification";
    $message = "Your OTP is: $otp";
    $headers = "From: deepishank@gmail.com"; // Change this to your email address

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

if(!$conn) {
    die("Unable to connect");
}

if(isset($_POST["username"], $_POST["password"], $_POST["email"])) {
    //$uname = mysqli_real_escape_string($conn, $_POST["username"]);
    //$pass = mysqli_real_escape_string($conn, $_POST["password"]);
    //$email = mysqli_real_escape_string($conn, $_POST["email"]);

    if (!filter_var( FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    $sql = "SELECT * FROM users_tutorial WHERE username = '$uname' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $otp = generateOTP();
        $sql_update_otp = "UPDATE users_tutorial SET otp = '$otp' WHERE username = '$uname'";
        mysqli_query($conn, $sql_update_otp);

        if(sendOTPByEmail($email, $otp)) {
            header("Location: otp_verification.php?username=$uname");
            exit();
        } else {
            echo "Failed to send OTP. Please try again later.";
        }
    } else {
        echo "Incorrect Username/Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Portal</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }
        .login-container form {
            text-align: center;
        }
        input[type=text], input[type=password], input[type=email], input[type=number] {
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 240px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            background-color: #4285f4;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type=submit]:hover {
            background-color: #2c75e7;
        }
        .signup-link {
            text-align: center;
            margin-top: 10px;
        }
        .signup-link a {
            color: #4285f4;
            text-decoration: none;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Portal</h2>
        <form method="POST" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required><br />
            <input type="password" name="password" placeholder="Password" required><br />
            <input type="email" name="email" placeholder="Email" required><br />
            <input type="submit" value="Send OTP">
        </form>
        <div class="signup-link">
            <a href="signup.php">Not Registered yet? Signup</a>
        </div>
    </div>
</body>
</html>
