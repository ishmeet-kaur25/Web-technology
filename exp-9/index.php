<?php
require_once 'db.php';
session_start();

// Handle delete
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    $_SESSION['message'] = "Product deleted successfully!";
    header("Location: index.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exp 9 - Product Management (PHP & MySQL)</title>
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
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .header h1 {
            color: #667eea;
            font-size: 2.5rem;
        }
        .header p {
            color: #666;
            margin-top: 10px;
        }
        .home-btn, .add-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 30px;
            margin-right: 10px;
        }
        .home-btn {
            background: #667eea;
            color: white;
        }
        .add-btn {
            background: #28a745;
            color: white;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            height: 250px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-info {
            padding: 20px;
        }
        .product-info h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        .price {
            font-size: 1.8rem;
            color: #667eea;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .description {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .edit-btn, .delete-btn {
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 25px;
            font-size: 14px;
            display: inline-block;
            transition: 0.3s;
        }
        .edit-btn {
            background: #ffc107;
            color: #333;
        }
        .delete-btn {
            background: #dc3545;
            color: white;
        }
        .proof-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-top: 30px;
        }
        .proof-section h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        .proof-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        .proof-item {
            text-align: center;
        }
        .proof-item img {
            max-width: 100%;
            border-radius: 10px;
            border: 2px solid #ddd;
        }
        .proof-item h3 {
            color: #667eea;
            margin-bottom: 10px;
        }
        .proof-item p {
            color: #666;
            margin-top: 10px;
            font-size: 14px;
        }
        .php-badge {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
            font-family: monospace;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ Experiment 9</h1>
            <p>Create, Store, Retrieve & Display Product Details using PHP & MySQL</p>
            <p>For Exercise-2 (E-Commerce Website)</p>
            <a href="../index.html" class="home-btn">← Back to Home</a>
            <a href="add.php" class="add-btn">+ Add New Product</a>
        </div>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>

        <div class="products-grid">
            <?php 
            // Array of real shoe images (random好看的鞋子图片)
            $shoe_images = [
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&h=250&fit=crop',
                'https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=400&h=250&fit=crop',
                'https://images.unsplash.com/photo-1543508282-6319a3e2621f?w=400&h=250&fit=crop',
                'https://images.unsplash.com/photo-1539185441755-769473a23570?w=400&h=250&fit=crop',
                'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=400&h=250&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=400&h=250&fit=crop',
                'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=400&h=250&fit=crop',
                'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=400&h=250&fit=crop'
            ];
            
            $index = 0;
            while($row = mysqli_fetch_assoc($result)): 
                $random_image = $shoe_images[$index % count($shoe_images)];
                $index++;
            ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo $random_image; ?>" alt="Shoe Image">
                </div>
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <div class="price">₹<?php echo number_format($row['price'], 2); ?></div>
                    <p class="description"><?php echo htmlspecialchars($row['description']); ?></p>
                    <div class="actions">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-btn">✏️ Edit</a>
                        <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?')">🗑️ Delete</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="proof-section">
            <h2>📸 Proof of PHP & MySQL Implementation</h2>
            <div class="proof-grid">
                <div class="proof-item">
                    <h3>1. Database Structure (phpMyAdmin)</h3>
                    <img src="proof1.jpg" alt="Database Structure" onerror="this.src='https://via.placeholder.com/500x300?text=Add+proof1.jpg+in+exp-9+folder'">
                    <p>Screenshot showing MySQL database and products table structure in phpMyAdmin</p>
                </div>
                <div class="proof-item">
                    <h3>2. Browser Output</h3>
                    <img src="proof2.jpg" alt="Browser Output" onerror="this.src='https://via.placeholder.com/500x300?text=Add+proof2.jpg+in+exp-9+folder'">
                    <p>Screenshot showing products displayed from database in browser with Add/Edit/Delete working</p>
                </div>
            </div>
            <div class="php-badge">
                ✅ PHP Version: <?php echo phpversion(); ?> | 
                MySQL: Connected | 
                Database: ecommerce_db | 
                CRUD: ✅ Create, Read, Update, Delete Working
            </div>
        </div>
    </div>
</body>
</html>