<?php 
session_start();

if (isset($_SESSION[ 'admin'])) {
    header('Location: dashboard.php');
    exit;
}
$error_message = '';
if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == 'admin' && $password == 'password') {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php'); 
         exit;
    } else {
        $error_message = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style/styles.css">
</head>
<body>
<h1>Login Form</h1>
<form method="POST" action="login.php">
<label for="username">Username:</label>
<input type="text" id="username" name="username">
<br><br>
<label for="password">Password:</label>
<input type="password" id="password" name="password">
<br><br>
<input type="submit" name="submit" value="Login">
<span style="color: red;"><?php echo $error_message; ?></span> 
</form>
</body>
</html>