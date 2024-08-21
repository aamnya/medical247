<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pid = $_POST['pid'];

    $servername = "sql110.infinityfree.com";
    $db_username = "if0_37099789";
    $db_password = "Adityabhise";
    $database = "if0_37099789_medical247database";

    try {
        $conn = new mysqli($servername, $db_username, $db_password, $database);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM userdata WHERE username = ? AND pass = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['pid'] = $pid;
            header('Location: inventory.php');
            exit();
        } else {
            $error_message = 'Invalid credentials. Please try again.';
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $error_message = 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedTrackr Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #28a745;
            font-weight: 700;
        }
        .form-control {
            border-radius: 50px;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            background-color: #f0f8f1;
        }
        .form-control:focus {
            border-color: #28a745;
            background-color: #e6f4ea;
        }
        .btn-primary {
            border-radius: 50px;
            padding: 0.75rem;
            width: 100%;
            background-color: #28a745;
            border: none;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
        .login-footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        .login-footer a {
            color: #28a745;
            text-decoration: none;
        }
        .login-footer a:hover {
            color: #218838;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>MedTrackr Login</h2>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label for="pid" class="form-label">Pharmacy ID</label>
            <input type="number" name="pid" class="form-control" id="pid" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <div class="login-footer">
        <p>Don't Have an Account? Create one here 👉 <a href="signup.php">Sign Up</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
