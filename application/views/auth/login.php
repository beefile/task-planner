<style>
  body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    height: 100vh;
    background: linear-gradient(to bottom, #D4536C, #FEA4AA, #F8F8F9);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem 1rem;
    box-sizing: border-box;
  }

  .login-card {
    background: #F8F8F9;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 3rem 2.5rem;
    width: 100%;
    max-width: 400px;
    text-align: center;
    box-sizing: border-box;
  }

  .form-control {
    border-radius: 15px;
    padding: 0.75rem;
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
  }

  .form-control:focus {
    border-color: #D4536C;
    box-shadow: 0 0 0 0.25rem rgba(212, 83, 108, 0.25);
  }

  .form-control.is-invalid {
    border-color: #D4536C; 
    box-shadow: 0 0 0 0.25rem rgba(212, 83, 108, 0.25);
  }

  .btn-login {
    border-radius: 15px;
    background-color: #ffdce0;
    border: none;
    color: #D4536C;
    font-weight: bold;
    width: 100%;
    padding: 0.75rem;
    transition: background 0.3s ease;
  }

  .btn-login:hover {
    background-color: #f8c9cf;
  }

a.form-text {
  font-size: 0.9rem;
  color: #a23c53; 
  text-decoration: none;
  font-weight: 600; 
}

a.form-text:hover {
  color: #a23c53;
  text-decoration: none;
  opacity: 0.8;
}


  .toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #888;
    font-size: 1.2rem;
  }

  .position-relative .form-control {
    padding-right: 2.5rem;
  }


  .error-message {
    color: #D4536C;
    margin-top: 0.3rem; 
    font-size: 0.88em;
    opacity: 0; 
    height: 0; 
    overflow: hidden; 
    transition: opacity 0.3s ease-out, height 0.3s ease-out; 
    padding-left: 0.5rem; 
    text-align: left; 
  }

  .error-message.show {
    opacity: 1; 
    height: auto; 
  }
</style>

<div class="login-card">
  <h3 class="mb-2 fw-bold">Welcome Back!</h3>
  <p class="text-muted mb-4">We missed you. Please enter your details.</p>

  <form id="loginForm" action="<?= base_url('planner/login_action') ?>" method="post" novalidate>
    <div class="mb-3 text-start">
      <label class="form-label">Email</label>
      <input type="text" name="username" class="form-control" id="email" placeholder="Enter your email" required>
      <div id="email-error" class="error-message"></div>
    </div>

    <div class="mb-3 text-start">
      <label class="form-label">Password</label>
      <div class="position-relative">
        <input type="password" name="password" class="form-control pe-5" id="password" placeholder="Enter your password" required>
        <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
      </div>
      <div id="password-error" class="error-message"></div>
    </div>

    <div class="d-flex justify-content-end mb-4">
      <a href="<?= base_url('auth/forgot_password') ?>" class="form-text">Forgot Password?</a>
    </div>

    <button type="submit" class="btn btn-login mb-3">Sign In</button>

    <p class="text-muted mt-3 mb-2">
      Don't have an account?
      <a href="<?php echo base_url('signup'); ?>" class="form-text">Sign Up</a>
    </p>
  </form>
</div>

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');
  const loginForm = document.getElementById('loginForm');
  const emailInput = document.getElementById('email');

  // Updated IDs for error messages to match CSS classes
  const emailError = document.getElementById('email-error');
  const passwordError = document.getElementById('password-error');

  togglePassword.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('bi-eye');
    this.classList.toggle('bi-eye-slash');
  });

  // Helper function to show error
  function showError(inputElement, errorElement, message) {
    inputElement.classList.add('is-invalid'); // Add invalid class to input
    errorElement.textContent = message;
    errorElement.classList.add('show'); // Show the error message smoothly
  }

  // Helper function to hide error
  function hideError(inputElement, errorElement) {
    inputElement.classList.remove('is-invalid'); // Remove invalid class
    errorElement.classList.remove('show'); // Hide the error message smoothly
    errorElement.textContent = ''; // Clear text
  }

  loginForm.addEventListener('submit', function(e) {
    let hasError = false;

    // Reset all errors and invalid states before validating
    hideError(emailInput, emailError);
    hideError(passwordInput, passwordError);

    const email = emailInput.value.trim();
    const password = passwordInput.value;

    // Email Validation (more robust)
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
      showError(emailInput, emailError, 'Enter a valid email address (e.g., user@domain.com).');
      hasError = true;
    }

    // Password Validation (12+ chars, uppercase, lowercase, number, symbol)
    const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/;
    if (!strongPasswordRegex.test(password)) {
      showError(passwordInput, passwordError, 'Password must be at least 12 characters long and include at least one uppercase letter, one lowercase letter, one number, and one symbol.');
      hasError = true;
    }

    if (hasError) {
      e.preventDefault(); // Prevent form submission if there are errors
    }
  });
</script>