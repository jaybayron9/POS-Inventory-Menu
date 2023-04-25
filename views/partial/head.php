<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= mysqli_fetch_array($set->settings())['bussiness_name'] ?></title>
    <link rel="shortcut icon" href="public/storage/eximage/<?= mysqli_fetch_array($set->settings())['logo'] !== Null ? mysqli_fetch_array($set->settings())['logo'] : 'icon.jpg' ?>" type="image/x-icon">

    <!-- Tailwind -->
    <script src="public/assets/js/tailwind.js"></script>
    <!-- Flowbite -->
    <link href="public/assets/css/flowbite.min.css" rel="stylesheet" />
    <!-- Ajax/Jquery -->
    <script src="public/assets/js/jquery.min.js"></script>
    <!-- SweetAlert -->
    <script src="public/assets/js/sweetalert.js"></script>
    <!-- DataTables -->
    <link href="public/assets/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="public/assets/css/responsive.dataTables.min.css" rel="stylesheet" />
    
</head>

<body class="overflow-x-hidden bg-rose-400">
    <!-- 
        background-image: url('public/storage/eximage/bg3.png');
        background-size: 25px 25px;
        background-repeat: repeat;  
    -->