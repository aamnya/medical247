
<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect the user to the login page
    header('Location: login.php');
    exit(); // Ensure no further code is executed after redirect
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MEDICAL 247</title>

    <style>
        /* Custom CSS styles */
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        #navbar {
            height: 2.5cm;
            background-color: #212121;
            border-bottom: 3px solid #4caf50;
        }

        #nav-name {
            color: green;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 12px 2px;
            font-size: 1.2cm;
            height: 50px;
        }

        #nav2-name {
            color: white;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            font-size: 1.2cm;
            padding: 12px 2px;
        }

        .container {
            max-width: 1000px;
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
            justify-content: center; /* Center the boxes horizontally */
            gap: 20px;
            margin-top: 30px;
        }

        .box {
            width: 200px; /* Adjusted width */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease; /* Adjusted transition duration */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            cursor: pointer;
            text-align: center; /* Center text inside box */
            color: #333; /* Default text color */
        }

        .box:hover {
            transform: scale(1.05);
        }

        .box-content h3 {
            margin: 0;
            font-size: 18px;
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

        .features {
            display: flex;
            justify-content: space-between;
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
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
    <div class="container-fluid" id="navid">
        <a class="navbar-brand" id="nav-name" href="#"><b>MEDICAL</b></a>
        <a class="navbar2-brand" id="nav2-name" href="#"><b>247</b></a>
    </div>
</nav>

<div class="container">
    <h1>Welcome to MEDICAL 247</h1>

    <div class="boxes-container">
        <div class="box" onclick="window.location='index1.php';">
            <div class="box-content">
                <h3>MedTracker</h3>
            </div>
        </div>
        <div class="box" onclick="window.location='insurance.php';">
            <div class="box-content">
                <h3>Insurance Policy</h3>
            </div>
        </div>
    </div>

    <p class="tagline"><b>Your health is our priority</b></p>

    <a href="inventory.php" class="inventory-btn">Go to Inventory</a>

    <div class="features">
        <div class="feature">
            <img src="https://source.unsplash.com/random/300x200?medicine" alt="Feature 1">
            <h3>Easy to Use</h3>
            <p>Our website is user-friendly and easy to navigate, making it simple for you to find the medicines you need.</p>
        </div>
        <div class="feature">
            <img src="https://source.unsplash.com/random/300x200?pharmacy" alt="Feature 2">
            <h3>Wide Selection</h3>
            <p>We have a wide selection of medicines available, ensuring that you can find what you need.</p>
        </div>
        <div class="feature">
            <img src="https://source.unsplash.com/random/300x200?quality" alt="Feature 3">
            <h3>Quality Assurance</h3>
            <p>We ensure that all of our medicines are of the highest quality, so you can trust that you're getting the best.</p>
        </div>
    </div>
</div>

</body>
</html>
