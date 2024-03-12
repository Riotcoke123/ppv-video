<?php
// Initialize PayPal API here

// Collect user information
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$county = $_POST['county'];
$phone = $_POST['phone'];

// Database connection settings
$host = 'your_mysql_host';
$username = 'your_mysql_username';
$password = 'your_mysql_password';
$dbname = 'ppv_database';

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Generate unique order ID
    $orderId = uniqid();

    // Store order information in the database
    $stmt = $pdo->prepare("INSERT INTO orders (order_id, name, email, address, city, state, zip, county, phone, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$orderId, $name, $email, $address, $city, $state, $zip, $county, $phone, 99.99]); // Hardcoded amount for simplicity

 // Prepare PayPal payment URL
$paypalUrl = "https://www.paypal.com/cgi-bin/webscr?...";
$redirectUrl = $paypalUrl . "&business=YOUR_PAYPAL_EMAIL&item_name=PPV_Video&amount=99.99&currency_code=USD&invoice=" . $orderId . "&notify_url=YOUR_IPN_HANDLER_URL&return=YOUR_SUCCESS_URL&cancel_return=YOUR_CANCEL_URL";

// Additional line you suggested (already present in the original code)
$redirectUrl = $paypalUrl . "&business=YOUR_PAYPAL_EMAIL&item_name=PPV_Video&amount=99.99&currency_code=USD&invoice=" . $orderId . "&notify_url=YOUR_IPN_HANDLER_URL&return=http://your-domain.com/success.php&cancel_return=http://your-domain.com/cancel.php";

// Return the redirect URL to the frontend
echo json_encode(['redirectUrl' => $redirectUrl]);
    

} catch (PDOException $e) {
    // Handle database connection errors
    echo "Error: " . $e->getMessage();
}
?>
