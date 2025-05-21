<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


$stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
  echo "
  <html>
  <head>
    <title>Thank You</title>
    <style>
      body {
        background: #111111;
        font-family: 'Poppins', sans-serif;
        text-align: center;
        padding: 50px;
      }
      .thank-you {
        background: #151515;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        display: inline-block;
      }
      .thank-you h2 {
        color: #ff5e57;
        margin-bottom: 20px;
      }
      .thank-you a {
        text-decoration: none;
        background: #ff5e57;
        color: #fff;
        padding: 12px 25px;
        border-radius: 30px;
        font-size: 16px;
        transition: background 0.3s;
      }
      .thank-you a:hover {
        background: #ff2e2e;
      }
    </style>
  </head>
  <body>
    <div class='thank-you'>
      <h2>Thank you! Your message has been sent. 🙌</h2>
      <a href='index.html'>Back to Home</a>
    </div>
  </body>
  </html>";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
