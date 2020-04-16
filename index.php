<?php

$base_url = 'http://gunavardhan.gq/';
$save_path = '_tmp';

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_GET['note']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_GET['note']) || strlen($_GET['note']) > 64) {

    
    
    header("Location: $base_url/" . substr(str_shuffle('01234579abcdefghjkmnpqrstwxyz'), -2));
    die;
}

$path = $save_path . '/' . $_GET['note'];

if (isset($_POST['text'])) {
      file_put_contents($path, $_POST['text']);

if (!strlen($_POST['text'])) {
        unlink($path);
    }
    die;
}


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
    <meta name="author" content=gunavardhan">
    <title>Notepad</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <textarea id="content">
        <?php
            if (is_file($path)) {
                
                print htmlspecialchars(file_get_contents($path), ENT_QUOTES, 'UTF-8');
            }
        ?>
        </textarea>
    </div>
    <pre id="printable"></pre>
    <script src="script.js"></script>
</body>
</html>
