<?php
helper('filesystem');
if (!function_exists('get_file_date')) {
    function get_file_date($file): int
    {
        return get_file_info(APPPATH . '../public/' . $file, 'date')['date'];
    }
} ?>
<!DOCTYPE html>
<html lang="en-ZW">

<head>
    <meta name="author" content="Isaac Machakata">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css?version=5.3.3">
    <link rel="stylesheet" href="/static/css/fas/all.css?version=6.0.0-alpha2">
    <link rel="stylesheet" href="/static/css/style.css?cache=<?= get_file_date('static/css/style.css') ?>">
    <link rel="shortcut icon" href="/static/images/core5.png" type="image/png">
    <script src="/static/js/jquery.3.7.1.min.js"></script>
    <title><?= $this->data['title'] ?></title>
</head>

<body>