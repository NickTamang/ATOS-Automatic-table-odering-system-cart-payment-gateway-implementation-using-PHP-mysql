
<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    // Ensure that an image file was selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        // Insert image data into database
        $insert = $conn->query("INSERT INTO food (name, image) VALUES ('$name', '$imgContent')");

        if ($insert) {
            echo "Image uploaded successfully.";
        } else {
            echo "Error uploading image. Please try again.";
        }
    } else {
        echo "Please select an image file.";
    }
}

$conn->close();
?>
