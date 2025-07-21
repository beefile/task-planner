<style>
  * {
    box-sizing: border-box;
  }

  html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to bottom, #D4536C, #FEA4AA, #F8F8F9);
  }

  body {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 5vh 1rem;
  }

  .login-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    padding: 3rem;
    width: 100%;
    max-width: 850px;
  }

  .login-card h3 {
    font-weight: 700;
    font-size: 1.6rem;
    color: #D4536C;
    text-align: center;
    margin-bottom: 0.8rem;
  }

  .login-card p {
    color: #6c757d;
    text-align: center;
    margin-bottom: 2rem;
    font-size: 0.95rem;
  }

  .form-label {
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 0.3rem;
    display: block;
    color: #333;
  }

  .form-control {
    width: 100%;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    border: 1px solid #ced4da;
    margin-bottom: 1.2rem;
    font-size: 0.95rem;
  }

  .form-control:focus {
    border-color: #D4536C;
    box-shadow: 0 0 0 0.25rem rgba(212, 83, 108, 0.15);
    outline: none;
  }

  .form-control:disabled {
    background-color: #f1f1f1;
    color: #555;
  }

  .form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
  }

  .form-col {
    flex: 1 1 0;
    min-width: 250px;
  }

  .btn-login {
    background-color: #ffdce0;
    color: #D4536C;
    font-weight: 600;
    border: none;
    border-radius: 12px;
    padding: 0.75rem;
    width: 100%;
    font-size: 1rem;
    transition: background 0.3s ease;
    margin-top: 0.5rem;
  }

  .btn-login:hover {
    background-color: #f8c9cf;
  }

  .error-message {
    color: #D4536C;
    font-size: 0.88rem;
    text-align: left;
    margin-top: -0.8rem;
    margin-bottom: 1rem;
    display: none;
  }

  .error-message.show {
    display: block;
  }

  @media (max-width: 768px) {
    .form-row {
      flex-direction: column;
    }

    .login-card {
      padding: 2rem 1.5rem;
    }
  }
</style>

<div class="login-card">
  <h3>Forgot Password</h3>
  <p>Enter your email and answer your security question to reset your password.</p>

  <form id="forgotPasswordForm" method="post" action="<?= base_url('auth/forgot_password') ?>" novalidate>
    <div class="form-row">
      <!-- LEFT -->
      <div class="form-col">
        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>

        <label class="form-label" for="securityQuestion">Security Question</label>
        <input type="text" id="securityQuestion" class="form-control" disabled value="<?= isset($security_question) ? $security_question : 'Enter your email first' ?>">

        <label class="form-label" for="security_answer">Answer</label>
        <input type="text" name="security_answer" id="security_answer" class="form-control" required>
      </div>

      <!-- RIGHT -->
      <div class="form-col">
        <label class="form-label" for="password">New Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <div id="passwordError" class="error-message">Must be 12+ characters with uppercase, lowercase, number & symbol.</div>

        <label class="form-label" for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
        <div id="confirmError" class="error-message">Passwords do not match.</div>
      </div>
    </div>

    <button type="submit" class="btn btn-login">Reset Password</button>

    <?php if (!empty($error)): ?>
      <p class="error-message show"><?= $error ?></p>
    <?php endif; ?>
  </form>
</div>

<script>
  document.getElementById('email').addEventListener('change', function () {
    const email = this.value;

    fetch('<?= base_url("auth/get_security_question_ajax") ?>', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'email=' + encodeURIComponent(email)
    })
    .then(response => response.json())
    .then(data => {
      const map = {
        birth_place: "Where were you born?",
        childhood_street: "What street did you grow up on?",
        fav_historical: "Who is your favorite historical figure?"
      };
      const question = map[data.security_question] || "No question found";
      document.getElementById('securityQuestion').value = question;
    });
  });

  document.getElementById('forgotPasswordForm').addEventListener('submit', function (e) {
    const password = document.getElementById('password');
    const confirm = document.getElementById('confirm_password');
    const passwordError = document.getElementById('passwordError');
    const confirmError = document.getElementById('confirmError');

    let hasError = false;
    const strongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/;

    if (!strongPassword.test(password.value)) {
      passwordError.classList.add('show');
      hasError = true;
    } else {
      passwordError.classList.remove('show');
    }

    if (password.value !== confirm.value) {
      confirmError.classList.add('show');
      hasError = true;
    } else {
      confirmError.classList.remove('show');
    }

    if (hasError) {
      e.preventDefault();
    }
  });
</script>
