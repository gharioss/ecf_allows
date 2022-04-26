<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['is_admin'] != 1) {
    header('Location: index.php');
}
