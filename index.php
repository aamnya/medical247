
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

    <title>MEDTRACKR</title>

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
            height:50px;      }

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

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        .form-label {
            font-weight: bold;
            color: #333;
            font-size: 18px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
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
            transition: transform 0.3s ease;
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
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
    <div class="container-fluid" id="navid">
        <a class="navbar-brand" id="nav-name" href="#"><b>MED</b></a>
        <a class="navbar2-brand" id="nav2-name" href="#"><b>TRACKR</b></a>
        
    </div>
</nav>

<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $med = $_POST['med'];
    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>CONNECTED</strong>  .
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>' ;
}

//$MED = "paracentamol";
$servername = "sql110.infinityfree.com";
$username = "if0_37099789";
$password = "Adityabhise";
$database = "if0_37099789_medical247database";
try {
    // Establish connection
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT pharmacy.pname,pharmacy.phone,pharmacy.location, medicine.mname, db.quantity
            FROM db
            INNER JOIN pharmacy ON db.pid = pharmacy.pid
            INNER JOIN medicine ON db.mid = medicine.mid
            WHERE mname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $med);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo '<div class="boxes-container">';
        // Loop through the rows and generate boxes
        while ($row = $result->fetch_assoc()) {
            // Generate a unique random seed for each box
            $random_seed = rand();
            echo '<div class="box" style="background-image: url(https://source.unsplash.com/random/300x200?medicine&' . $random_seed . ');" onclick="window.location=\'' . $row['location'] . '\'">';
            echo '<div class="box-content">';
            echo '<h3>' . $row['pname'] . '</h3>';
            echo '<p>Medicine: ' . $row['mname'] . '</p>';
            echo '<p>Quantity: ' . $row['quantity'] . '</p>';
            echo '<p>Phone: ' . $row['phone'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Welcome to MedTRACKR </strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed</strong> ' . $e->getMessage() . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
?>



<p class="tagline"><b>Your health is our priority</b></p>

<form action="" method="post" >
    <div class="mb-3">
        <label for="med" class="form-label"></label>
        <input type="text" name="med" value="<?php echo isset($med) ? htmlspecialchars($med) : ''; ?>" class="form-control" id="med" aria-describedby="emailHelp" placeholder="Search here...." oninput="this.value = this.value.toUpperCase()">

    </div>


    <button type="submit" class="btn btn-primary">Search</button>
</form>

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

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">MEDICAL247</strong>
        <small>11 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Hello, world! This is a toast message.
    </div>
</div>

<div style="text-align: center; margin-top: 20px;">
    <form action="logout.php" method="post">
        <button type="submit" class="btn btn-danger">Log Out</button>
    </form>
</div>



</body>
</html>




