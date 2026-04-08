<?php
session_start();

// Set cookie for last visit
if(isset($_COOKIE['last_visit'])) {
    $last_visit = $_COOKIE['last_visit'];
} else {
    $last_visit = "First time visitor";
}

// Handle login
$login_error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if($username == "admin" && $password == "1234") {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['login_time'] = date('Y-m-d H:i:s');
        
        setcookie("user", $username, time() + (86400 * 30), "/");
        setcookie("last_visit", date('Y-m-d H:i:s'), time() + (86400 * 30), "/");
        
        header("Location: dashboard.php");
        exit();
    } else {
        $login_error = "Invalid credentials! Use: admin / 1234";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exp 10 - Login</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container { max-width: 450px; width: 100%; }
        .header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 { color: #667eea; }
        .form-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
        }
        .form-group { margin-bottom: 20px; }
        label { font-weight: bold; display: block; margin-bottom: 8px; }
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: bold;
        }
        .error { color: red; margin-bottom: 15px; text-align: center; }
        .home-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🍪 Experiment 10</h1>
            <p>Sessions & Cookies</p>
            <a href="../index.html" class="home-btn">← Back</a>
        </div>
        <div class="form-container">
            <h2 style="text-align:center;">🔐 Login</h2>
            <?php if($login_error): ?>
                <div class="error"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit">Login →</button>
            </form>
            <p style="text-align:center; margin-top:15px; font-size:12px;">Demo: admin / 1234</p>
        </div>
    </div>
</body>
</html>