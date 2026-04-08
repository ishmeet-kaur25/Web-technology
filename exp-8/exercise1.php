<?php
session_start();

$name = $email = $message = "";
$name_err = $email_err = $message_err = "";
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
            $name_err = "❌ Name should contain only letters (2-50 characters)";
            $isValid = false;
        }
    }
    
    // Email validation
    if (empty($_POST["email"])) {
        $email_err = "❌ Email is required";
        $isValid = false;
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "❌ Enter a valid email address";
            $isValid = false;
        }
    }
    
    // Message validation
    if (empty($_POST["message"])) {
        $message_err = "❌ Message is required";
        $isValid = false;
    } else {
        $message = htmlspecialchars(trim($_POST["message"]));
        if (strlen($message) < 10) {
            $message_err = "❌ Message must be at least 10 characters";
            $isValid = false;
        }
    }
    
    if ($isValid) {
        $_SESSION['contact_data'] = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'submitted_at' => date('Y-m-d H:i:s')
        ];
        $success_msg = "✅ Message sent successfully! I'll get back to you soon.";
        $name = $email = $message = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercise 1 - Personal Website Contact Form</title>
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
            color: #667eea;
        }
        .home-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 20px;
            background: #667eea;
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
            border-color: #667eea;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            transform: scale(1.02);
        }
        hr {
            margin: 20px 0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .info-table th, .info-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .info-table th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="exp-container">
        <div class="exp-header">
            <h1>📄 Exercise 1</h1>
            <p>Personal Website - Contact Form with PHP Validation</p>
            <a href="index.php" class="home-btn">← Back to Experiment 8</a>
        </div>

        <div class="form-container">
            <h2>📧 Send me a message</h2>
            <p>Fill the form below. All fields are required.</p>
            <hr>

            <?php if($success_msg): ?>
                <div class="success"><?php echo $success_msg; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your full name">
                    <div class="error"><?php echo $name_err; ?></div>
                </div>

                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your email address">
                    <div class="error"><?php echo $email_err; ?></div>
                </div>

                <div class="form-group">
                    <label>Message *</label>
                    <textarea name="message" rows="5" placeholder="Enter your message (minimum 10 characters)"><?php echo $message; ?></textarea>
                    <div class="error"><?php echo $message_err; ?></div>
                </div>

                <button type="submit">📤 Send Message</button>
            </form>

            <h2 style="margin-top: 30px;">📸 Original Personal Website Details</h2>
            <table class="info-table">
                <tr><th>Field</th><th>Details</th></tr>
                <tr><td>Name</td><td>Ishmeet Kaur</td></tr>
                <tr><td>Course</td><td>B.Tech Computer Science</td></tr>
                <tr><td>College</td><td>Jain (Deemed-to-be) University</td></tr>
                <tr><td>Email</td><td>ishmeetk152@gmail.com</td></tr>
                <tr><td>Phone</td><td>+91 90367 63320</td></tr>
            </table>
        </div>
    </div>
</body>
</html>