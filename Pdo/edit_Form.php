<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration Form</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="script.js"></script>
</head>
<body>
    <form method="post" action="edit.php" onsubmit="return validateForm()">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="firstname">First Name:</label>
        <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>">
        <span class="error" id="fnameError"></span>
        <br>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>">
        <span class="error" id="lnameError"></span>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error" id="emailError"></span>
        <br>

		<label for="mobile">Mobile Number:</label>
		<input type="tel" id="mobile" name="mobile" value="<?php echo $mobile; ?>">
		<span class="error" id="mobileError"></span>
		<br>

		<label for="department">Department:</label>
		<input type="text" id="department" name="department" value="<?php echo $department; ?>">

		<span class="error" id="departmentError"></span>
		<br>

		<input type="submit" name="submit" value="Submit" >
	</form>
    
</body>
</html>