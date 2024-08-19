<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedTrackr Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
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
            color: #28a745; /* Green Color */
            font-weight: 700;
        }

        .form-control {
            border-radius: 50px;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s, background-color 0.3s;
            background-color: #f0f8f1; /* Light green background */
        }

        .form-control:focus {
            border-color: #28a745; /* Green border on focus */
            box-shadow: none;
            background-color: #e6f4ea; /* Darker green on focus */
        }

        .btn-primary {
            border-radius: 50px;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 700;
            width: 100%;
            background-color: #28a745; /* Green button */
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .form-label {
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .alert {
            margin-top: 1rem;
        }

        .login-footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .login-footer a {
            color: #28a745; /* Green link */
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-footer a:hover {
            color: #218838; /* Darker green on hover */
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>MedTrackr Login</h2>

    <?php
    session_start(); // Start the session

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

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
                // Successful login, set session variables
                $_SESSION['username'] = $username;
                // Redirect to the index page
                header('Location: index.php');
                exit();
            } else {
                echo '<div class="alert alert-danger" role="alert">Invalid credentials. Please try again.</div>';
            }

            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
        }
    }
    ?>

    <!-- Login Form -->
    <form action="" method="post">
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
        <p>Dont Have Account Create here👉 <a href="signup.php">sign Up</a></p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
