<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Administrator') {
    redirectToLogin();
}
?>
<?php include '../includes/header.php'; ?>
<h2>Administrator Dashboard</h2>

<div class="dashboard">
    <div class="card">
        <h3>Manage Users</h3>
        <a href="../modules/manage_users.php">View Users</a>
        <a href="../modules/add_user.php">Add User</a>
    </div>
    
    <div class="card">
        <h3>Manage Cases</h3>
        <a href="../modules/manage_cases.php">View Cases</a>
        <a href="../modules/add_case.php">Add Case</a>
    </div>
    
    <div class="card">
        <h3>Reports</h3>
        <a href="../modules/reports.php">View Reports</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
