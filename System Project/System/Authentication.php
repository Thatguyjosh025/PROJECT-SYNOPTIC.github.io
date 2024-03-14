<?php 
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    // Redirect to login page or any other appropriate action
    header("Location: Index.php");
    exit();
}
?>