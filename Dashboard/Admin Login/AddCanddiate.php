<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sanitize input data
$cname = mysqli_real_escape_string($conn, $_POST['cname']);
$cparty = mysqli_real_escape_string($conn, $_POST['cparty']);

// File upload details for symbol
$images = $_FILES['symbol']['name'];
$tmp_name = $_FILES['symbol']['tmp_name'];

// File upload details for photo
$image = $_FILES['photo']['name'];
$tmp_name1 = $_FILES['photo']['tmp_name'];

// Define upload directory
$upload_dir = "Image/";

// Check if files are uploaded successfully
if (is_uploaded_file($tmp_name) && is_uploaded_file($tmp_name1)) {
    // Create SQL query
    $query = "INSERT INTO addcandidate (cname, cparty, symbol, photo) VALUES ('$cname', '$cparty', '$images', '$image')";

    // Debugging: Print query to check for errors
    echo "SQL Query: " . $query; // Remove or comment out this line after debugging

    // Insert data into database
    $insert = mysqli_query($conn, $query);

    if ($insert) {
        // Move files to upload directory
        if (move_uploaded_file($tmp_name, $upload_dir . $images) && move_uploaded_file($tmp_name1, $upload_dir . $image)) {
            echo '
                <script>
                    alert("Candidate Added Successfully");
                    location = "AdminDashboard.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Error in moving uploaded files.");
                    location = "AddCandidate.php";
                </script>
            ';
        }
    } else {
        // Print detailed error message
        echo "Database Insertion Error: " . mysqli_error($conn);
    }
} else {
    echo '
        <script>
            alert("Error uploading files. Please try again.");
            location = "AddCandidate.php";
        </script>
    ';
}

// Close connection
mysqli_close($conn);
?>
