<?php
    session_start();
    if (!isset($_SESSION["accountID"]))
        header("Location: login.php");
?>

<head>
    <style>
        body {
            background: linear-gradient(to right, #3c00a4ff, #5500c5ff);
        }
            .card:hover {
        transform: scale(1.03);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    </style>
</head>

<?php include "partials/_header.php"; ?>
<?php include "partials/_sidebar.php"; ?>


<div id="main-content" class="p-4">
    <?php include "partials/_istatistik.php"; ?>
</div>
<?php include "partials/_footer.php"; ?>