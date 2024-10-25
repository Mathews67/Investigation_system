<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Administrator') {
    redirectToLogin();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "<p>Error deleting user: " . $stmt->error . "</p>";
    }
} else {
    header("Location: manage_users.php");
    exit();
}
?>
