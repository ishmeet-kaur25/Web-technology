<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

$username_cookie = isset($_COOKIE['user']) ? $_COOKIE['user'] : "Not set";
$last_visit_cookie = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : "First time";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sessions & Cookies</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        .header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 { color: #28a745; }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
        }
        .card h2 {
            color: #667eea;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .card p { margin: 12px 0; color: #555; }
        .session-info, .cookie-info {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
        }
        .product-item {
            background: #f0f0f0;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 25px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 30px;
        }
        .home-btn {
            display: inline-block;
            padding: 10px 25px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            margin-right: 10px;
        }
        .proof-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-top: 30px;
            text-align: center;
        }
        .proof-section img {
            max-width: 100%;
            border-radius: 10px;
            border: 2px solid #ddd;
            margin-top: 15px;
        }
        .php-badge {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ Welcome <?php echo $_SESSION['username']; ?>!</h1>
            <p>Experiment 10 - Sessions & Cookies Demo</p>
            <a href="index.php" class="home-btn">← Login</a>
            <a href="logout.php" class="logout-btn">🚪 Logout</a>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h2>📦 Session Data</h2>
                <div class="session-info">
                    <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
                    <p><strong>Logged in as:</strong> <?php echo $_SESSION['username']; ?></p>
                    <p><strong>Login Time:</strong> <?php echo $_SESSION['login_time']; ?></p>
                </div>
            </div>

            <div class="card">
                <h2>🍪 Cookie Data</h2>
                <div class="cookie-info">
                    <p><strong>Username Cookie:</strong> <?php echo $username_cookie; ?></p>
                    <p><strong>Last Visit Cookie:</strong> <?php echo $last_visit_cookie; ?></p>
                    <p><strong>Cookie Expiry:</strong> 30 days</p>
                </div>
            </div>

            <div class="card">
                <h2>🍽️ Products</h2>
                <div class="product-item"><span>🥘 Butter Chicken</span><span>₹320</span></div>
                <div class="product-item"><span>🫔 Shahi Paneer</span><span>₹220</span></div>
                <div class="product-item"><span>🍗 Chicken Tikka</span><span>₹300</span></div>
                <div class="product-item"><span>🥛 Lassi</span><span>₹70</span></div>
                <div class="product-item"><span>🍨 Gulab Jamun</span><span>₹90</span></div>
            </div>
        </div>

        <div class="proof-section">
            <h2>📸 Proof: Sessions & Cookies Working</h2>
            <img src="proof.jpg" alt="Proof Screenshot" onerror="this.src='https://via.placeholder.com/600x300?text=Add+proof.jpg+in+exp-10+folder'">
            <div class="php-badge">
                ✅ PHP Version: <?php echo phpversion(); ?> | 
                Session ID: <?php echo session_id(); ?> | 
                Cookie: user=<?php echo $username_cookie; ?> | 
                Status: ✅ Working
            </div>
        </div>
    </div>
</body>
</html>