<?php
session_start();

// Database connection parameters
$host = 'localhost';
$dbname = 'login';
$username = 'root';
$password = '';

// Establish database connection
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data based on session
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secured Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .secured-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        .secured-container h2 {
            color: #333;
        }
        .logout-container {
            margin-top: 20px;
        }
        .logout-container a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="secured-container">
        <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p>This is a secured page.</p>
        <div class="logout-container">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
