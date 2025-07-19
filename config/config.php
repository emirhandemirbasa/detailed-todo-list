<?php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$yasakli_klasorler = [
    "/todo/partials/",
    "/todo/libs/",
    "/todo/modals/",
    "/todo/actions/",
    "/todo/settings/"
];

foreach ($yasakli_klasorler as $klasor) {
    if (strpos($url, $klasor) === 0) {
        header("Location: /todo/index.php");
        exit;
    }
}
?>
