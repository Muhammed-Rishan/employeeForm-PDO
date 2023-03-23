	function validateForm() {
		var firstname = document.getElementById("fname").value;
		var lastname = document.getElementById("lname").value;
		var email = document.getElementById("email").value;
		var mobile = document.getElementById("mobile").value;
		var department = document.getElementById("department").value;

		document.getElementById("fnameError").innerHTML = "";
		document.getElementById("lnameError").innerHTML = "";
		document.getElementById("emailError").innerHTML = "";
		document.getElementById("mobileError").innerHTML = "";
		document.getElementById("departmentError").innerHTML = "";

		var isValid = true;

		if (firstname == "") {
			document.getElementById("fnameError").innerHTML = "Please enter your first name.";
			isValid = false;
		}

		if (lastname == "") {
			document.getElementById("lnameError").innerHTML = "Please enter your last name.";
			isValid = false;
		}

		if (email == "") {
			document.getElementById("emailError").innerHTML = "Please enter your email address.";
			isValid = false;
		} else if (!validateEmail(email)) {
			document.getElementById("emailError").innerHTML = "Please enter a valid email address.";
			isValid = false;
		}

		if (mobile == "") {
			document.getElementById("mobileError").innerHTML = "Please enter your mobile number.";
			isValid = false;
		} else if (!validateMobile(mobile)) {
			document.getElementById("mobileError").innerHTML = "Please enter a valid mobile number.";
			isValid = false;
		}

		if (department == "") {
			document.getElementById("departmentError").innerHTML = "Please enter a department.";
			isValid = false;
		}

		return isValid;
	}

	function validateEmail(email) {

		var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return emailRegex.test(email);
	}

	function validateMobile(mobile) {

		var mobileRegex = /^[0-9]{10}$/;
		return mobileRegex.test(mobile);
	}
