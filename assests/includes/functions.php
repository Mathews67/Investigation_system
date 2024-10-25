<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirectToLogin() {
    header("Location: login.php");
    exit();
}

function getUserRole($role) {
    switch ($role) {
        case 'Administrator':
            return 'admin_dashboard.php';
        case 'Criminal Records Officer':
            return 'officer_dashboard.php';
        case 'Investigator':
            return 'investigator_dashboard.php';
        default:
            return '404.php';
    }
}
?>
