
const form = document.getElementById('edit-form');

form.addEventListener('submit', function(e) {
    // Prevent form submission
    e.preventDefault();
    console.log("hello");

    // Clear previous error messages
    document.getElementById('fname-error').innerText = '';
    document.getElementById('lname-error').innerText = '';
    document.getElementById('username-error').innerText = '';
    document.getElementById('password-error').innerText = '';
    document.getElementById('mobile-error').innerText = ''; // Clear mobile error
    document.getElementById('email-error').innerText = '';  // Clear email error
    const roleErrorElement = document.getElementById('role-error');
    if (roleErrorElement) {
        roleErrorElement.innerText = '';
    }

    // Get form field values
    const fname = form.first_name.value.trim();
    const lname = form.last_name.value.trim();
    const username = form.username.value.trim();
    const password = form.password.value.trim();
    const mobile = form.mobile.value.trim();  // Get mobile value
    const email = form.email.value.trim();    // Get email value
    let role = null;
    if (form.select_user) {
        role = form.select_user.value;
    }

    let valid = true; // Flag to track if the form is valid

    // Validate First Name
    if (fname.length < 3) {
        document.getElementById('fname-error').innerText = 'First name must be at least 3 characters.';
        valid = false;
    }

    // Validate Last Name
    if (lname.length < 3) {
        document.getElementById('lname-error').innerText = 'Last name must be at least 3 characters.';
        valid = false;
    }

    // Validate Username
    if (username.length < 5) {
        document.getElementById('username-error').innerText = 'Username must be at least 5 characters.';
        valid = false;
    }

    // Validate Password
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById('password-error').innerText = 'Password must be at least 8 characters long and include a letter, a number, and a special character.';
        valid = false;
    }

    // Validate Mobile (only numbers, 10-13 digits)
    const mobilePattern = /^[0-9]{10,13}$/;
    if (!mobilePattern.test(mobile)) {
        document.getElementById('mobile-error').innerText = 'Please enter a valid mobile number (10-13 digits).';
        valid = false; // Set valid to false if there's an error
    }

    // Validate Email (standard email format)
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        document.getElementById('email-error').innerText = 'Please enter a valid email address.';
        valid = false; // Set valid to false if there's an error
    }

    // Validate Role Selection (for admins only)
    if (form.select_user && (role === '' || role === 'Select')) {
        document.getElementById('role-error').innerText = 'Please select a user role.';
        valid = false;
    }

    // If all validations pass, submit the form
    if (valid) {
        form.submit();
    }
});

