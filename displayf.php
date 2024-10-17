<?php

// Define the directory where uploaded files are stored
$uploadsDirectory = 'C:/xampp/htdocs/Comp493/indexpage/uploads/';

// Get the filename from the query string
$filename = isset($_GET['filename']) ? basename($_GET['filename']) : null;

// If no filename is provided or the file does not exist, display an error message
if (!$filename || !file_exists($uploadsDirectory . $filename)) {
    die('File not found');
}

// Determine the MIME type of the file
$mime = mime_content_type($uploadsDirectory . $filename);

// Set appropriate headers for the file type
header('Content-Type: ' . $mime);

// Output the file contents
readfile($uploadsDirectory . $filename);
