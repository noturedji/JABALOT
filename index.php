<?php
session_start();
if (!empty($_SESSION['user_id'])) {
    header('Location: ' . ($_SESSION['user_type'] === 'admin'
        ? 'admin/dashboard.php'
        : 'employee/dashboard.php'));
    exit;
}
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | JABA Payroll System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="frontend/design/css/index.css">
</head>
<body>

    <header class="topbar">
        <div class="topbar-container">
            <a href="#" class="brand-link">
                <div class="brand-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
                <div class="brand-text">
                    <span class="brand-name">JABA</span>
                    <span class="brand-sub">Employee &amp; Payroll Management</span>
                </div>
            </a>
        </div>
    </header>

    <main class="login-wrapper">
        <div class="login-card">
            <div class="card-header-badges">
                <span class="badge-employee">Portal</span>
                <span class="security-tag">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    Secure Login
                </span>
            </div>

            <div class="login-title-area">
                <div class="employee-icon-circle">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h1>Sign In</h1>
                <p>Enter your credentials to view your payslips, attendance and requests.</p>
            </div>

            <?php if ($error): ?>
                <div style="background:#fee2e2;color:#991b1b;padding:10px 14px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                    Invalid email or password.
                </div>
            <?php endif; ?>

            <form action="backend/funchandler.php" method="POST" class="login-form">
                <input type="hidden" name="action" value="login">
                <div class="form-box">
                    <div class="input-group">
                        <label for="employee-email">Email</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <input type="email" id="employee-email" name="email" placeholder="you@jaba-payroll.com" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="employee-password">Password</label>
                            <a href="#" class="forgot-link">Forgot password?</a>
                        </div>
                        <div class="input-wrapper">
                            <svg class="input-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input type="password" id="employee-password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Toggle password visibility">
                                <svg id="eye-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Sign In</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

            <div class="login-footer">
                <span>New employee?</span>
                <a href="employeesignup.html">Create an account</a>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const input = document.getElementById('employee-password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>