   <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, #D4536C, #FEA4AA, #F8F8F9);
            display: flex; 
            justify-content: center;
            align-items: center;
            padding: 5vh 1rem; 
            min-height: 100vh;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 3rem;
            width: 100%;
            max-width: 850px; 
            margin: auto; 
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
            cursor: pointer;
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

        .inline-error {
            color: #d8000c;
            font-size: 0.8rem;
            margin-top: -0.6rem;
            margin-left: 4px;
            display: inline-block;
        }

        .login-btn {
            display: inline-block;
            color: #D4536C;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            background: none;
            border: none;
            padding: 0;
            margin-top: 0.5rem;
            cursor: pointer;
        }

        .login-btn:hover {
            color: #b03d55;
        }

        .center-text {
            text-align: center;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column; 
                gap: 1.5rem; 
            }

            .form-col {
                min-width: unset;
                width: 100%; 
                flex: none;
            }

            .login-card {
                padding: 2rem 1.5rem; 
            }

        
            .form-control {
                padding: 0.6rem 0.9rem;
            }

            .login-card h3 {
                font-size: 1.5rem;
            }
            .login-card p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 3vh 0.8rem; 
            }

            .login-card {
                padding: 1.5rem 1rem; 
                border-radius: 15px; 
            }

            .login-card h3 {
                font-size: 1.3rem;
                margin-bottom: 0.6rem;
            }

            .login-card p {
                font-size: 0.85rem;
                margin-bottom: 1.5rem;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .form-control {
                padding: 0.5rem 0.8rem;
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }

            .btn-login {
                padding: 0.6rem;
                font-size: 0.95rem;
            }

            .error-message {
                font-size: 0.8rem;
                margin-top: -0.7rem;
                margin-bottom: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h3>Forgot Password</h3>
        <p>Enter your email and answer your security question to reset your password.</p>

        <form id="forgotPasswordForm" method="post" action="<?= base_url('auth/forgot_password') ?>" novalidate>
            <div class="form-row">
                <div class="form-col">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="your.email@example.com" required>

                    <label class="form-label" for="security_question">Security Question</label>
                    <select name="security_question" id="security_question" class="form-control" required>
                        <option value="">-- Select a question --</option>
                        <option value="birth_place">Where were you born?</option>
                        <option value="childhood_street">What street did you grow up on?</option>
                        <option value="fav_historical">Who is your favorite historical figure?</option>
                    </select>

                    <label class="form-label" for="security_answer">Answer</label>
                    <input type="text" name="security_answer" id="security_answer" class="form-control" placeholder="Your answer" required>
                    <?php if (isset($error)) : ?>
                        <span class="inline-error"><?= $error ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-col">
                    <label class="form-label" for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password" required>
                    <div id="passwordError" class="error-message" aria-live="polite">Must be 12+ characters with uppercase, lowercase, number & symbol.</div>

                    <label class="form-label" for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm new password" required>
                    <div id="confirmError" class="error-message" aria-live="polite">Passwords do not match.</div>
                </div>
            </div>
            <button type="submit" class="btn btn-login">Reset Password</button>
        </form>
    </div>

    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const passwordError = document.getElementById('passwordError');
            const confirmError = document.getElementById('confirmError');

            let hasError = false;
            const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/;

            if (!strongPasswordRegex.test(passwordInput.value)) {
                passwordError.classList.add('show');
                hasError = true;
            } else {
                passwordError.classList.remove('show');
            }

            if (passwordInput.value !== confirmPasswordInput.value) {
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