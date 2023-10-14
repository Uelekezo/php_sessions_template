<?php
session_start();

if (!isset($_SESSION['user_data'])) {
    header('Location: login.php');
    exit();
}

// Check if the array exists in the session.
if (isset($_SESSION['user_data'])) {
    $data = $_SESSION['user_data'];

    // Now, you can access individual elements in the array.
    $username = $data['username'];
    $email = $data['email'];
    $age = $data['age'];

    // Use the data as needed.
    echo "Username: $username, Email: $email, Age: $age";
} else {
    // The array doesn't exist in the session.
    echo "User data not found in the session.";
}

// You can access the username using $_SESSION['username'] here.
// Add a link or button for logging out.
echo '<a href="logout.php">Log Out</a>';

?>

<!-- Your page content here -->