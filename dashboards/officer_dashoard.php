<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Criminal Records Officer') {
    redirectToLogin();
}
?>
<?php include '../includes/header.php'; ?>
<h2>Criminal Records Officer Dashboard</h2>

<div class="dashboard">
    <div class="card">
        <h3>Criminal Records</h3>
        <a href="../modules/evidence.php">Manage Records</a>
    </div>
    
    <div class="card">
        <h3>Background Checks</h3>
        <a href="../modules/notes.php">Conduct Background Checks</a>
    </div>
    
    <div class="card">
        <h3>Report Preparation</h3>
        <a href="../modules/reports.php">Prepare Reports</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
