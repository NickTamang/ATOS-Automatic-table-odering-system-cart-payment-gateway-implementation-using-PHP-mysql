<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Images</title>
</head>
<body>
    <h2>Uploaded Images</h2>

    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "menu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to fetch images from the database
    function getImages() {
        global $conn;
        $images = array();

        $result = $conn->query("SELECT name, image FROM food");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $images[] = $row;
            }
        }

        return $images;
    }

    $images = getImages();

    if (!empty($images)) {
        foreach ($images as $image) {
            echo '<div style="text-align: center;">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($image['image']) . '" alt="' . $image['name'] . '" /><br>';
            echo '<p>' . $image['name'] . '</p>';
            echo '</div>';
        }
    } else {
        echo "No images found.";
    }

    $conn->close();
    ?>
</body>
</html>
