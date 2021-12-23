<!DOCTYPE html><html lang="en">
<!-- header.php -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= APP_NAME ?></title>

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" 
        href="/css/custom.css">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" 
        href="/css/bootstrap-superhero.css">
    <link type="text/css" rel="stylesheet" 
        href="/css/bootstrap-default.css">

    <script src="/js/jquery-3.4.1.min.js"></script>

   <!-- Needed for Hamburger Menu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Data Tables -->
    <link type="text/css" rel="stylesheet" 
        href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myDataTable').DataTable();
        });
    </script>
</head>

<body>
  <?php # require BASEDIR . '/app/debug/debug.php';