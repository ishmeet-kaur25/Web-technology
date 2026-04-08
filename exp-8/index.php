<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Experiment 8 - Form Handling & Validation using PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .exp-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .exp-header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .exp-header h1 {
            color: #667eea;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .exp-title {
            font-size: 1.2rem;
            color: #333;
            font-weight: bold;
        }

        .exp-desc {
            color: #666;
            margin-top: 5px;
        }

        .home-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: 0.3s;
        }

        .home-btn:hover {
            background: #5a67d8;
            transform: scale(1.05);
        }

        .exp-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .card h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            color: #666;
            margin-bottom: 5px;
        }

        .card-desc {
            font-size: 0.85rem;
            color: #999;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .proof-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-top: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .proof-section h2 {
            color: #333;
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #667eea;
            display: inline-block;
            width: 100%;
            padding-bottom: 10px;
        }

        .proof-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 25px;
        }

        .proof-item {
            text-align: center;
        }

        .proof-item h3 {
            color: #667eea;
            margin-bottom: 15px;
        }

        .proof-item img {
            max-width: 100%;
            border-radius: 10px;
            border: 2px solid #ddd;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .proof-item p {
            color: #666;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .php-badge {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-family: monospace;
            color: #667eea;
            border-left: 4px solid #667eea;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="exp-container">
        <div class="exp-header">
            <h1>🔬 Experiment 8</h1>
            <p class="exp-title">Form Handling and Form Validation using PHP</p>
            <p class="exp-desc">For Exercise-1 (Personal Website) & Exercise-2 (E-Commerce Website)</p>
            <a href="../index.html" class="home-btn">← Back to Home</a>
        </div>

        <div class="exp-cards">
            <div class="card">
                <div class="card-icon">📄</div>
                <h2>Exercise 1</h2>
                <p>Personal Website - Contact Form</p>
                <p class="card-desc">PHP validation for Name, Email, Message fields</p>
                <a href="exercise1.php" class="btn">View Exercise 1 →</a>
            </div>

            <div class="card">
                <div class="card-icon">🛒</div>
                <h2>Exercise 2</h2>
                <p>E-Commerce - Order Form</p>
                <p class="card-desc">PHP validation for Name, Phone, Address, Payment</p>
                <a href="exercise2.php" class="btn">View Exercise 2 →</a>
            </div>
        </div>

        <div class="proof-section">
            <h2>📸 Proof of PHP Implementation</h2>
            
            <div class="proof-grid">
                <div class="proof-item">
                    <h3>Exercise 1 - Contact Form (Proof)</h3>
                    <img src="proof1.jpg" alt="Exercise 1 Proof" onerror="this.src='https://via.placeholder.com/500x300?text=Add+proof1.jpg'">
                    <p><em>Screenshot showing form validation/success for Personal Website Contact Form</em></p>
                </div>
                
                <div class="proof-item">
                    <h3>Exercise 2 - Order Form (Proof)</h3>
                    <img src="proof2.jpg" alt="Exercise 2 Proof" onerror="this.src='https://via.placeholder.com/500x300?text=Add+proof2.jpg'">
                    <p><em>Screenshot showing order placement for E-commerce Order Form</em></p>
                </div>
            </div>

            <div class="php-badge">
                ✅ PHP Version: <?php echo phpversion(); ?> | 
                Server: <?php echo $_SERVER['SERVER_SOFTWARE']; ?> |
                Method: POST/GET Handling |
                Status: ✅ Validation Working
            </div>
        </div>
    </div>
</body>
</html>