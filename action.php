<?php
// Set the content type to HTML
header('Content-Type: text/html; charset=utf-8');

// Get the method used
$method = $_SERVER['REQUEST_METHOD'];

// Style for the page
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        h1 {
            color: #333;
        }
        .data-container {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .warning {
            color: #ff0000;
            font-weight: bold;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-link:hover {
            background-color: #45a049;
        }
        .request-details {
            background-color: #e9e9e9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        code {
            background-color: #f4f4f4;
            padding: 2px 4px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <h1>Form Data Received via ' . $method . ' Method</h1>
';

// Process data based on the method
if ($method === 'GET') {
    // Get the data from the URL parameters
    $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Not provided';
    $password = isset($_GET['password']) ? htmlspecialchars($_GET['password']) : 'Not provided';
    
    echo '
    <div class="data-container">
        <h2>Data Received (GET):</h2>
        <p><strong>Name:</strong> ' . $name . '</p>
        <p><strong>Password:</strong> ' . $password . ' <span class="warning">(Warning: Password is visible in the URL!)</span></p>
    </div>
    
    <div class="request-details">
        <h3>Request Details:</h3>
        <p>The data was sent in the URL. You can see it in your browser\'s address bar.</p>
        <p>Current URL: <code>' . htmlspecialchars($_SERVER['REQUEST_URI']) . '</code></p>
    </div>
    ';
    
} elseif ($method === 'POST') {
    // Get the data from the POST body
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Not provided';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : 'Not provided';
    
    echo '
    <div class="data-container">
        <h2>Data Received (POST):</h2>
        <p><strong>Name:</strong> ' . $name . '</p>
        <p><strong>Password:</strong> ' . $password . '</p>
    </div>
    
    <div class="request-details">
        <h3>Request Details:</h3>
        <p>The data was sent in the HTTP request body and is not visible in the URL.</p>
        <p>Current URL: <code>' . htmlspecialchars($_SERVER['REQUEST_URI']) . '</code></p>
        <p>Notice that no data parameters are shown in the URL above.</p>
    </div>
    ';
} else {
    // Handle any other methods (though only GET and POST are used in this example)
    echo '<p>Unsupported method: ' . $method . '</p>';
}

// Back link
echo '
    <a href="javascript:history.back()" class="back-link">Go Back</a>
</body>
</html>
';
?>