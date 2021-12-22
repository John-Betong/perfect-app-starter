<?php declare(strict_types=1);

if (isset($_GET['theme']))
{
    //TODO Need allowed values array
    //This will fail if not https
    setcookie('theme', $_GET['theme'], strtotime('+90 days'), '/', '', true);
    redirect('./');
}
$theme = $_COOKIE['theme'] ?? $_COOKIE['theme'] ?? 'default';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= APP_NAME ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap-<?= $theme ?>.css">

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="/css/custom.css">

    <script src="/js/jquery-3.4.1.min.js"></script>

    <!-- Needed for Hamburger Menu -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myDataTable').DataTable();
        });
    </script>

</head>

<body>
