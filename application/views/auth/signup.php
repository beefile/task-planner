<style>
  body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to bottom, #D4536C, #FEA4AA, #F8F8F9);
    padding: 3rem 1rem;
    display: flex;
    justify-content: center;
  }

  .login-card {
    background: #F8F8F9;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 3rem 2.5rem;
    width: 100%;
    max-width: 800px;
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

  .form-text a {
    font-size: 0.9rem;
    color: #D4536C;
    text-decoration: none;
  }

  .form-text a:hover {
    text-decoration: underline;
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
    margin-top: 0.5rem;
    font-size: 0.88em;
    opacity: 0;
    height: 0;
    overflow: hidden;
    transition: opacity 0.3s ease-out, height 0.3s ease-out;
    padding-left: 0.5rem;
  }

  .error-message.show {
    opacity: 1;
    height: auto;
  }
    .form-text a {
        font-size: 0.9rem;
        color: #D4536C;
        text-decoration: none !important; 
        font-weight: normal; 
    }
    .form-text a:hover {
        text-decoration: none !important; 
    }

    .btn-signin-dark-pink {
        color: #C2185B !important; 
        font-weight: bold !important;
        text-decoration: none !important;
    }

    .btn-signin-dark-pink:hover {
        color: #9C144A !important;
        text-decoration: none !important;
    }
</style>

<div class="login-card">
    <h3 class="mb-2 fw-bold text-center">Get Started</h3>
    <p class="text-muted mb-4 text-center">Fill in the following details to create a new account.</p>

    <form id="signupForm" action="<?= base_url('planner/signup_action') ?>" method="post" novalidate>
        <div class="row mb-3">
            <div class="col-md-6 text-start">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" id="first_name" required>
                <div id="first-name-error" class="error-message"></div>
            </div>
            <div class="col-md-6 text-start">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="last_name" required>
                <div id="last-name-error" class="error-message"></div>
            </div>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
            <div id="email-error" class="error-message"></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 text-start">
                <label class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" name="password" class="form-control" id="password" required>
                    <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
                </div>
                <div id="password-error" class="error-message"></div>
            </div>
            <div class="col-md-6 text-start">
                <label class="form-label">Confirm Password</label>
                <div class="position-relative">
                    <input type="password" name="confirm_password" class="form-control" id="confirmPassword" required>
                    <i class="bi bi-eye-slash toggle-password" id="toggleConfirmPassword"></i>
                </div>
                <div id="confirm-password-error" class="error-message"></div>
            </div>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label">Security Question</label>
            <select name="security_question" class="form-control" required>
                <option value="">-- Select a question --</option>
                <option value="birth_place">Where were you born?</option>
                <option value="childhood_street">What street did you grow up on?</option>
                <option value="fav_historical">Who is your favorite historical figure?</option>
            </select>
            <div id="security-question-error" class="error-message"></div> </div>

        <div class="mb-3 text-start">
            <label class="form-label">Answer</label>
            <input type="text" name="security_answer" class="form-control" required>
            <div id="security-answer-error" class="error-message"></div> </div>

        <button type="submit" class="btn btn-login mb-3">Sign Up</button>

        <p class="text-muted mt-3 mb-0 text-center">
            Already have an account?
         <a href="<?= base_url('login') ?>" class="form-text btn-signin-dark-pink">Sign In</a>
        </p>
    </form>
</div>


<script>
    function showError(inputElement, errorElement, message) {
        inputElement.classList.add('is-invalid');
        errorElement.textContent = message;
        errorElement.classList.add('show');
    }

    function hideError(inputElement, errorElement) {
        inputElement.classList.remove('is-invalid');
        errorElement.classList.remove('show');
        errorElement.textContent = '';
    }

    // --- Password Toggle ---
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // --- Input References ---
    const signupForm = document.getElementById('signupForm');
    const firstNameInput = document.getElementById('first_name');
    const lastNameInput = document.getElementById('last_name');
    const emailInput = document.getElementById('email');
    const securityQuestionInput = document.querySelector('select[name="security_question"]');
    const securityAnswerInput = document.querySelector('input[name="security_answer"]');

    // --- Error Message Element References ---
    const firstNameError = document.getElementById('first-name-error');
    const lastNameError = document.getElementById('last-name-error');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirm-password-error');
    const securityQuestionError = document.getElementById('security-question-error');
    const securityAnswerError = document.getElementById('security-answer-error');

    // --- Enforce Alphabetical Input ---
    function enforceAlphabeticalInput(inputElement) {
        inputElement.addEventListener('input', function() {
            // Allow letters (a-z, A-Z) and spaces
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });
    }

    enforceAlphabeticalInput(firstNameInput);
    enforceAlphabeticalInput(lastNameInput);

    // --- Form Submission Validation ---
    signupForm.addEventListener('submit', function(e) {
        let hasError = false; // Flag to track if any error exists

        // --- 1. Reset all errors ---
        hideError(firstNameInput, firstNameError);
        hideError(lastNameInput, lastNameError);
        hideError(emailInput, emailError);
        hideError(passwordInput, passwordError);
        hideError(confirmPasswordInput, confirmPasswordError);
        hideError(securityQuestionInput, securityQuestionError);
        hideError(securityAnswerInput, securityAnswerError);

        // --- 2. Get trimmed values ---
        const firstName = firstNameInput.value.trim();
        const lastName = lastNameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value; // Password should not be trimmed as spaces can be part of it
        const confirmPassword = confirmPasswordInput.value;
        const securityQuestion = securityQuestionInput.value;
        const securityAnswer = securityAnswerInput.value.trim();

        // --- 3. Validate ALL required fields FIRST ---

        // First Name
        if (firstName === '') {
            showError(firstNameInput, firstNameError, 'First Name is required.');
            hasError = true;
        } else if (firstName.length < 2) {
            showError(firstNameInput, firstNameError, 'First Name must be at least 2 characters long.');
            hasError = true;
        } else if (!/^[a-zA-Z]+$/.test(firstName)) {
            showError(firstNameInput, firstNameError, 'First Name can only contain alphabetical characters.');
            hasError = true;
        }

        // Last Name
        if (lastName === '') {
            showError(lastNameInput, lastNameError, 'Last Name is required.');
            hasError = true;
        } else if (lastName.length < 2) {
            showError(lastNameInput, lastNameError, 'Last Name must be at least 2 characters long.');
            hasError = true;
        } else if (!/^[a-zA-Z]+$/.test(lastName)) {
            showError(lastNameInput, lastNameError, 'Last Name can only contain alphabetical characters.');
            hasError = true;
        }

        // Email
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (email === '') {
            showError(emailInput, emailError, 'Email is required.');
            hasError = true;
        } else if (!emailRegex.test(email)) {
            showError(emailInput, emailError, 'Please enter a valid email address (e.g., example@domain.com).');
            hasError = true;
        }

        // Password
        const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/;
        if (password === '') {
            showError(passwordInput, passwordError, 'Password is required.');
            hasError = true;
        } else if (!strongPasswordRegex.test(password)) {
            showError(passwordInput, passwordError, 'Password must be 12+ characters with uppercase, lowercase, number, and symbol.');
            hasError = true;
        }


        if (confirmPassword === '') {
            showError(confirmPasswordInput, confirmPasswordError, 'Confirm Password is required.');
            hasError = true;
        } else if (password !== confirmPassword) {
            showError(confirmPasswordInput, confirmPasswordError, 'Passwords do not match.');
            hasError = true;
        }

        if (securityQuestion === '') { 
            showError(securityQuestionInput, securityQuestionError, 'Please select a security question.');
            hasError = true;
        }


        if (securityAnswer === '') {
            showError(securityAnswerInput, securityAnswerError, 'Please provide an answer.');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault(); 
        }
    });

    emailInput.addEventListener('blur', function() {
        const email = emailInput.value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (email === '' || !emailRegex.test(email)) {
            return;
        }

        fetch('<?= base_url('planner/check_email_exists') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(email)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    showError(emailInput, emailError, 'This email is already registered.');
                } else {
                    hideError(emailInput, emailError);
                }
            })
            .catch(error => {
                console.error('Error checking email:', error);

            });
    });
</script>