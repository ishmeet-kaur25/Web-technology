<?php
require_once 'db.php';
session_start();

$id = $_GET['id'] ?? 0;
$result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$product = mysqli_fetch_assoc($result);

if(!$product) {
    header("Location: index.php");
    exit();
}

$name = $product['name'];
$price = $product['price'];
$description = $product['description'];
$name_err = $price_err = $description_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;
    
    if(empty($_POST["name"])) {
        $name_err = "Product name is required";
        $isValid = false;
    } else {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
    }
    
    if(empty($_POST["price"])) {
        $price_err = "Price is required";
        $isValid = false;
    } else {
        $price = floatval($_POST["price"]);
        if($price <= 0) {
            $price_err = "Price must be greater than 0";
            $isValid = false;
        }
    }
    
    if(empty($_POST["description"])) {
        $description_err = "Description is required";
        $isValid = false;
    } else {
        $description = mysqli_real_escape_string($conn, $_POST["description"]);
        if(strlen($description) < 10) {
            $description_err = "Description must be at least 10 characters";
            $isValid = false;
        }
    }
    
    if($isValid) {
        mysqli_query($conn, "UPDATE products SET name='$name', price=$price, description='$description' WHERE id=$id");
        $_SESSION['message'] = "Product updated successfully!";
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container { max-width: 600px; margin: 0 auto; }
        .header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 { color: #ffc107; }
        .home-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 25px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 30px;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 20px;
        }
        .form-group { margin-bottom: 20px; }
        label { font-weight: bold; display: block; margin-bottom: 8px; color: #333; }
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
        }
        input:focus, textarea:focus { border-color: #ffc107; outline: none; }
        .error { color: #dc3545; font-size: 14px; margin-top: 5px; }
        button {
            background: #ffc107;
            color: #333;
            padding: 12px 30px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✏️ Edit Product</h1>
            <a href="index.php" class="home-btn">← Back to Products</a>
        </div>
        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label>Product Name *</label>
                    <input type="text" name="name" value="<?php echo $name; ?>">
                    <div class="error"><?php echo $name_err; ?></div>
                </div>
                <div class="form-group">
                    <label>Price (₹) *</label>
                    <input type="number" step="0.01" name="price" value="<?php echo $price; ?>">
                    <div class="error"><?php echo $price_err; ?></div>
                </div>
                <div class="form-group">
                    <label>Description *</label>
                    <textarea name="description" rows="4"><?php echo $description; ?></textarea>
                    <div class="error"><?php echo $description_err; ?></div>
                </div>
                <button type="submit">💾 Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>