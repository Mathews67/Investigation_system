<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Investigator') {
    redirectToLogin();
}
?>
<?php include '../includes/header.php'; ?>
<h2>Investigator Dashboard</h2>

<div class="dashboard">
    <div class="card">
        <h3>Case Investigations</h3>
        <a href="../modules/case_investigation.php">Manage Investigations</a>
    </div>
    
    <div class="card">
        <h3>Evidence</h3>
        <a href="../modules/evidence.php">View Evidence</a>
    </div>
    
    <div class="card">
        <h3>Reports</h3>
        <a href="../modules/reports.php">Generate Reports</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
