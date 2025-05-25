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
        header("Location: admin.php"); // Redirect to your admin panel
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="index.css">
  <script src="index.js" defer></script>
  <title>Login</title>
  </head>
<body class="bg-light" style="background-color:beige;">
    
 <!-- Sidebar -->
 <div style="text-align: left; margin-top: 10px; margin-left: 10px;">
    <a href="index.html" style="
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

<div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4 text-center">Login</h2>

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

</body>
</html>
