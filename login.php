<?php
include_once __DIR__ .'/libs/csrf/csrfprotector.php';

// Initialise CSRFProtector library
try {
    csrfProtector::init();
} catch (configFileNotFoundException $e) {
}
if(!isset($_SESSION)) { session_start(); }

if (isset($_SESSION['user_data'])) {
    header('Location: page1.php');
    exit();
}

    if (isset($_SESSION['referer']))
    {
        $orig_url = $_SESSION['referer'];
        echo "Orig_url: $orig_url <br>";
    }
    
    
    



?>
<!DOCTYPE html>
<html>
<head>
    <title>POST Form</title>
</head>
<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        
        // Data submitted via the form
        $username = $_POST['username'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $data = array(
            'username' => $username,
            'email' => $email,
            'age' => $age
        );
    
        // Save the updated data in the session.
        $_SESSION['user_data'] = $data;
        // Process and validate the data as needed.

        // // For demonstration, let's just display the submitted data.
        echo "Username: $username<br>";
        echo "Email: $email<br>";
        echo "Age: $age<br>";
       // After a successful login, check if there is a referer in the session.
if (isset($_SESSION['referer'])) {
    $referer = $_SESSION['referer'];
    // Clear the referer from the session, so it's not used again.
    unset($_SESSION['referer']);
    
    // Redirect the user back to the referring page.
    header("Location: $referer");
    exit();
} else {
    // If there's no referer in the session, redirect to a default page.
    header('Location: page1.php');
    exit();
}
    }
    ?>

    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <br><br>

        <label for="age">Age:</label>
        <input type="text" id="age" name="age">
        <br><br>

        <!-- Include a hidden input field to detect form submission -->
        <input type="hidden" name="submit" value="1">

        <input type="submit" value="Submit">
    </form>
</body>
</html>
