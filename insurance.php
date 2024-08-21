<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INSURANCE 247</title>

    <style>
        /* Custom CSS styles */
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        #nav-name,
        #nav2-name {
            display: inline-block; /* or display: block; */
            height: 100px; /* Adjust the height as needed */
            /* Your other styling properties */
            font-size: 1.2cm;
        }
        #navbar {
            height:2cm;
            background-color: #212121;
            border-bottom: 3px solid #4caf50;
        }

        #nav-name {
            color: green;
            font-family: 'Roboto', sans-serif;
           
            margin: 0;
            padding: 12px 2px;
            height:50px;      
        }

        #nav2-name {
            color: white;
            font-family: 'Roboto', sans-serif;
            
            margin: 0;
            padding: 12px 2px;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            color: #4caf50;
            text-align: center;
            margin-bottom: 30px;
        }

        .tagline {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-top: 50px;
        }

        .boxes-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .box {
            width: 200px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            cursor: pointer;
        }

        .box:hover {
            transform: scale(1.05);
        }

        .box-content {
            text-align: center;
        }

        .box-content h3 {
            margin-bottom: 10px;
        }

        .box-content p {
            margin: 0;
        }

        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .feature {
            text-align: center;
            width: 30%;
            padding: 10px;
        }

        .feature img {
            width: 100%;
            border-radius: 10px;
        }

        .logout-btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .inventory-btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            margin: 20px auto;
        }

        .inventory-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
    <div class="container-fluid" id="navid">
        <a class="navbar-brand" id="nav-name" href="#"><b>INSURANCE</b></a>
        <a class="navbar2-brand" id="nav2-name" href="#"><b>247</b></a>
    </div>
</nav>

<?php
$servername = "sql110.infinityfree.com";
$username = "if0_37099789";
$password = "Adityabhise";
$database = "if0_37099789_insurance";

try {
    // Establish connection
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch insurance policies
    $sql = "SELECT name, link FROM insurance";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo '<div class="boxes-container">';
        // Loop through the rows and generate boxes
        while ($row = $result->fetch_assoc()) {
            echo '<div class="box" style="background-image: url(https://source.unsplash.com/random/300x200?insurance);" onclick="window.location=\'' . $row['link'] . '\'">';
            echo '<div class="box-content">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-info" role="alert">
                <strong>No insurance policies found.</strong>
              </div>';
    }
    
    $conn->close();
} catch (Exception $e) {
    echo '<div class="alert alert-danger" role="alert">
            <strong>Error:</strong> ' . $e->getMessage() . '
          </div>';
}
?>

<p class="tagline"><b>Your protection, our priority</b></p>

<!-- Inventory Button -->
<a href="inventory.php" class="inventory-btn">Go to Inventory</a>

<div class="features">
    <div class="feature">
        <img src="https://source.unsplash.com/random/300x200?insurance" alt="Feature 1">
        <h3>Easy to Use</h3>
        <p>Our website is user-friendly and easy to navigate, making it simple for you to find the insurance policies you need.</p>
    </div>
    <div class="feature">
        <img src="https://source.unsplash.com/random/300x200?policy" alt="Feature 2">
        <h3>Wide Selection</h3>
        <p>We have a wide selection of insurance policies available, ensuring that you can find what suits your needs.</p>
    </div>
    <div class="feature">
        <img src="https://source.unsplash.com/random/300x200?coverage" alt="Feature 3">
        <h3>Quality Assurance</h3>
        <p>We ensure that all our policies offer the best coverage and service, so you can trust that you're well protected.</p>
    </div>
</div>

<div class="logout-btn-container">
    <form action="logout.php" method="post">
        <button type="submit" class="btn btn-danger">Log Out</button>
    </form>
</div>

</body>
</html>
