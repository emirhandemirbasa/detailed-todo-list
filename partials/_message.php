<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
?>
<?php
if (isset($_SESSION["message"])) {
    echo "<div class='alert alert-" . $_SESSION["type"] . "' role='alert'>" . $_SESSION["message"] . "</div>";
    unset($_SESSION["message"]);
    unset($_SESSION["type"]);
}
