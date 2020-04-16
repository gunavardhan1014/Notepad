<?php

// Base URL of the website, without trailing slash.
$base_url = 'http://gunasekhar.gq/';

// Path to the directory to save the notes in, without trailing slash.
// Should be outside of the document root, if possible.
$save_path = '_tmp';

// Disable caching.
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// If no name is provided or it contains invalid characters or it is too long.
if (!isset($_GET['note']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['note']) || strlen($_GET['note']) > 64) {

    // Generate a name with 5 random unambiguous characters. Redirect to it.
    header("Location: $base_url/" . substr(str_shuffle('01234579abcdefghjkmnpqrstwxyz'), -2));
    die;
}

$path = $save_path . '/' . $_GET['note'];

if (isset($_POST['text'])) {

    // Update file.
    file_put_contents($path, $_POST['text']);

    // If provided input is empty, delete file.
    if (!strlen($_POST['text'])) {
        unlink($path);
    }
    die;
}

// Output raw file if client is curl or explicitly requested.
if (isset($_GET['raw']) || strpos($_SERVER['HTTP_USER_AGENT'], 'curl') === 0) {
    if (is_file($path)) {
        header('Content-type: text/plain');
        print file_get_contents($path);
    } else {
        header('Error');
    }
    die;
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Python,HTML,CSS,Java,JavaScript,PHP,C">
    <meta name="description" content="programming">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript,Java,Python,PHP,C">
    <meta name="author" content="Gunasekhar">
    <title>Notepad</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <textarea id="content">
        <?php
            if (is_file($path)) {
                //echo $path;
                print htmlspecialchars(file_get_contents($path), ENT_QUOTES, 'UTF-8');
            }
        ?>
        </textarea>
    </div>
    <pre id="printable"></pre>
    <script src="script.js"></script>
</body>
</html>
