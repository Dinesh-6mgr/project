<?php

session_start();

// Define default username and password
define('DEFAULT_USER', 'admin');
define('DEFAULT_PASS', 'admin123');

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === DEFAULT_USER && $pass === DEFAULT_PASS) {
        // Correct credentials, create session
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user;
        $_SESSION["login_time_stamp"] = time();  
        header("Location: admin.php"); // Redirect to your admin panel
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}


include "includes/header.php";
?>

    
 <!-- Sidebar -->
 <div style="text-align: left; margin-top: 10px; margin-left: 10px;">
    <a href="index.php" style="
        display: inline-block;
        padding: 12px 24px;
        background-color:rgb(24, 20, 235);
        color: white;
        text-decoration: none;
        font-size: 16px;
        border-radius: 8px;
        transition: background-color 0.3s;
    " onmouseover="this.style.backgroundColor='#0s056b3'" onmouseout="this.style.backgroundColor='#007bff'">
        Home
    </a>
</div>

<div class="container mt-5" ">
    <h2 class="mb-5 text-center">Login</h2>

    <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" name="username" type="text" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" name="password" type="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

<?php
include "includes/footer.php";
?>