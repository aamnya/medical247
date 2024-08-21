<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login2.php');
    exit();
}

$servername = "sql110.infinityfree.com";
$username = "if0_37099789";
$password = "Adityabhise";
$database = "if0_37099789_medical247database";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve pharmacy details based on PID from the session
$pid = $_SESSION['pid'];
$sql = "SELECT * FROM pharmacy WHERE pid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pid);
$stmt->execute();
$pharmacyResult = $stmt->get_result();
$pharmacy = $pharmacyResult->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mid = $_POST['mid'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO db (pid, mid, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $pid, $mid, $quantity);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Medicine added successfully!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}

$sql = "SELECT * FROM medicine";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f4ea;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #d4edda;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            flex: 1;
        }

        .profile-details h3 {
            margin: 0;
            color: #28a745;
        }

        .profile-details iframe {
            width: 100%;
            border: none;
            height: 150px;
            border-radius: 5px;
            margin-top: 1rem;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 50px;
            padding: 0.75rem;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 50px;
            padding: 0.75rem;
            width: 100%;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            border-radius: 5px;
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

        h2 {
            color: #28a745;
            font-weight: 700;
        }

        .logout-form {
            margin-top: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="profile-header">
        <div class="profile-image">
            <!-- Placeholder for pharmacy image -->
            <img src="path/to/image.jpg" alt="Pharmacy Image">
        </div>
        <div class="profile-details">
            <h3><?php echo htmlspecialchars($pharmacy['pname']); ?></h3>
            <iframe src="https://www.google.com/maps?q=<?php echo urlencode($pharmacy['location']); ?>&output=embed" title="Pharmacy Location"></iframe>
        </div>
    </div>
    <h2>Add Medicines to Inventory</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="mid" class="form-label">Medicine</label>
            <select name="mid" class="form-control" id="mid" required>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['mid']; ?>"><?php echo $row['mname']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Medicine</button>
    </form>

    <!-- Logout Button -->
    <div class="logout-form">
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
