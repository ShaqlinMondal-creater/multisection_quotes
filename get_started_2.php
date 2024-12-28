<?php
// Set content type to JSON
header('Content-Type: application/json');

// Include the database connection
include 'connection/db_connect.php'; // Adjust this path as needed

// Check database connection
if (!$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Query to fetch image file names from the database
$sql = "SELECT file_name FROM uploads where category_id=28";
$result = $conn->query($sql);

// Initialize an array to store image data
$images = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = [
            'file_name' => $row['file_name'] // Assuming the database column is named 'file_name'
        ];
    }
    echo json_encode($images); // Return the image data as JSON
} else {
    echo json_encode(['error' => 'No images found']);
}

// Close the database connection
$conn->close();
?>
