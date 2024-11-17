// show and hide register form

function show_reg_form() {
  document.querySelector(".reg_form").classList.add("show_register_form");
  document.querySelector(".creat_account").classList.add("hide_creat_account");
}

function close_register_form() {
  document.querySelector(".reg_form").classList.remove("show_register_form");
  document
    .querySelector(".creat_account")
    .classList.remove("hide_creat_account");
}

// for hide show password

document.querySelectorAll(".pass_icon_show").forEach((show_pass) => {
  show_pass.addEventListener("click", () => {
    show_pass.classList.add("hide_pass_icon");
    let input_pass = show_pass.previousElementSibling;
    let pass_icon_hide = show_pass.nextElementSibling;
    pass_icon_hide.classList.add("show_pass");
    input_pass.setAttribute("type", "text");
  });
});

document.querySelectorAll(".pass_icon_hide").forEach((hide_pass) => {
  hide_pass.addEventListener("click", () => {
    let show_pass_icon = hide_pass.previousElementSibling;
    show_pass_icon.classList.remove("hide_pass_icon");
    let input_pass = hide_pass.previousElementSibling.previousElementSibling;
    hide_pass.classList.remove("show_pass");
    input_pass.setAttribute("type", "password");
  });
});
  // admin key input access
  document.querySelector("select[name='select_user']").addEventListener("change", function () {
    if (this.value == "1") {
      console.log("select");
      document.getElementById("admin-key").style.display = "block";
    } else {
      document.getElementById("admin-key").style.display = "none";
      console.log("unselect");
    }
  });

  // Form submission validation
const form = document.getElementById('register-form');
form.addEventListener('submit', function(e) {
  // Prevent form submission
  e.preventDefault();

  // Clear previous error messages
  document.getElementById('fname-error').innerText = '';
  document.getElementById('lname-error').innerText = '';
  document.getElementById('username-error').innerText = '';
  document.getElementById('password-error').innerText = '';
  document.getElementById('role-error').innerText = '';
  document.getElementById('mobile-error').innerText = ''; // Clear mobile error
  document.getElementById('email-error').innerText = '';  // Clear email error

  // Get form field values
  const fname = form.first_name.value.trim();
  const lname = form.last_name.value.trim();
  const username = form.username.value.trim();
  const password = form.password.value.trim();
  const mobile = form.mobile.value.trim();  // Get mobile value
  const email = form.email.value.trim();    // Get email value
  const role = form.select_user.value;

  let valid = true; // Flag to track overall form validity

  // Validate First Name
  if (fname.length < 3) {
    document.getElementById('fname-error').innerText = 'First name must be at least 3 characters.';
    valid = false; // Set valid to false if there's an error
  }

  // Validate Last Name
  if (lname.length < 3) {
    document.getElementById('lname-error').innerText = 'Last name must be at least 3 characters.';
    valid = false; // Set valid to false if there's an error
  }

  // Validate Username
  if (username.length < 5) {
    document.getElementById('username-error').innerText = 'Username must be at least 5 characters.';
    valid = false; // Set valid to false if there's an error
  }

  // Validate Password
  const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; // At least 8 characters, one letter, one number, one special character
  if (!passwordRegex.test(password)) {
    document.getElementById('password-error').innerHTML = `Password must be at least 8 characters long and <br> include a letter, a number, and a special character.`;
    valid = false; // Set valid to false if there's an error
  }

  // Validate Role Selection
  if (role === '' || role === 'Select') {
    document.getElementById('role-error').innerText = 'Please select a user role.';
    valid = false; // Set valid to false if there's an error
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

  // If all validations pass, submit the form
  if (valid) {
    console.log('Form validation passed. Submitting form...');
    form.submit(); // Submit the form
  }
});





