<?php
session_start();

$name = $phone = $address = $payment = "";
$name_err = $phone_err = $address_err = $payment_err = "";
$success_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;
    
    // Name validation
    if (empty($_POST["name"])) {
        $name_err = "❌ Name is required";
        $isValid = false;
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
        if (!preg_match("/^[a-zA-Z ]{2,50}$/", $name)) {
            $name_err = "❌ Name should contain only letters";
            $isValid = false;
        }
    }
    
    // Phone validation
    if (empty($_POST["phone"])) {
        $phone_err = "❌ Phone number is required";
        $isValid = false;
    } else {
        $phone = htmlspecialchars(trim($_POST["phone"]));
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phone_err = "❌ Enter valid 10-digit phone number";
            $isValid = false;
        }
    }
    
    // Address validation
    if (empty($_POST["address"])) {
        $address_err = "❌ Delivery address is required";
        $isValid = false;
    } else {
        $address = htmlspecialchars(trim($_POST["address"]));
        if (strlen($address) < 10) {
            $address_err = "❌ Address must be at least 10 characters";
            $isValid = false;
        }
    }
    
    // Payment validation
    if (empty($_POST["payment"])) {
        $payment_err = "❌ Please select a payment method";
        $isValid = false;
    } else {
        $payment = $_POST["payment"];
    }
    
    if ($isValid) {
        $order_id = "LDH" . time() . rand(100, 999);
        
        $_SESSION['order_data'] = [
            'order_id' => $order_id,
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'payment' => $payment,
            'order_date' => date('Y-m-d H:i:s')
        ];
        
        $success_msg = "✅ Order placed successfully! Your Order ID: $order_id";
        $name = $phone = $address = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercise 2 - E-commerce Order Form</title>
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
            max-width: 700px;
            margin: 0 auto;
        }
        .exp-header {
            background: white;
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            margin-bottom: 30px;
        }
        .exp-header h1 {
            color: #d32f2f;
        }
        .home-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 20px;
            background: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 25px;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
        }
        input:focus, textarea:focus {
            border-color: #d32f2f;
            outline: none;
        }
        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
        }
        button {
            background: #d32f2f;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
        }
        button:hover {
            background: #b71c1c;
        }
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 8px;
        }
        .radio-group input {
            width: auto;
            margin-right: 5px;
        }
        .menu-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .menu-table th, .menu-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .menu-table th {
            background: #f2f2f2;
        }
        hr {
            margin: 20px 0;
        }
        .restaurant-info {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="exp-container">
        <div class="exp-header">
            <h1>🍽️ Exercise 2</h1>
            <p>E-Commerce - Order Form with PHP Validation</p>
            <a href="index.php" class="home-btn">← Back to Experiment 8</a>
        </div>

        <div class="form-container">
            <h2>🛒 Place Your Order</h2>
            <p>Ludhiana Da Dhaba - Fresh food delivered to your door</p>
            <hr>

            <?php if($success_msg): ?>
                <div class="success"><?php echo $success_msg; ?></div>
            <?php endif; ?>

            <h3>📋 Today's Specials</h3>
            <table class="menu-table">
                <tr><th>Item</th><th>Price</th></tr>
                <tr><td>Butter Chicken</td><td>₹320</td></tr>
                <tr><td>Shahi Paneer</td><td>₹220</td></tr>
                <tr><td>Garlic Naan</td><td>₹40</td></tr>
                <tr><td>Gulab Jamun</td><td>₹90</td></tr>
                <tr><td>Lassi</td><td>₹70</td></tr>
            </table>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your full name">
                    <div class="error"><?php echo $name_err; ?></div>
                </div>

                <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="tel" name="phone" value="<?php echo $phone; ?>" placeholder="10-digit mobile number">
                    <div class="error"><?php echo $phone_err; ?></div>
                </div>

                <div class="form-group">
                    <label>Delivery Address *</label>
                    <textarea name="address" rows="3" placeholder="Enter complete delivery address"><?php echo $address; ?></textarea>
                    <div class="error"><?php echo $address_err; ?></div>
                </div>

                <div class="form-group">
                    <label>Payment Method *</label>
                    <div class="radio-group">
                        <label><input type="radio" name="payment" value="COD" <?php echo ($payment == 'COD') ? 'checked' : ''; ?>> Cash on Delivery</label>
                        <label><input type="radio" name="payment" value="Online" <?php echo ($payment == 'Online') ? 'checked' : ''; ?>> Online Payment</label>
                    </div>
                    <div class="error"><?php echo $payment_err; ?></div>
                </div>

                <button type="submit">✅ Confirm Order</button>
            </form>

            <div class="restaurant-info">
                <h3>📞 Ludhiana Da Dhaba - Contact Info</h3>
                <p><strong>Address:</strong> Gill Road, Kailash Nagar, Ludhiana, Punjab – 141006</p>
                <p><strong>Phone:</strong> +91 98760 43210</p>
                <p><strong>Email:</strong> contact@ludhianadadhaba.com</p>
                <p><strong>Timing:</strong> 11:00 AM - 11:00 PM (All days)</p>
            </div>
        </div>
    </div>
</body>
</html>