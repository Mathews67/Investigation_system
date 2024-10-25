<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Administrator') {
    redirectToLogin();
}

// Fetch cases for management
$cases = $conn->query("SELECT * FROM cases");
?>
<?php include '../includes/header.php'; ?>
<h2>Manage Cases</h2>
<a href="add_case.php" class="button">Add Case</a>
<table>
    <tr>
        <th>ID</th>
        <th>Case Number</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($case = $cases->fetch_assoc()) { ?>
        <tr>
            <td><?= $case['id'] ?></td>
            <td><?= $case['case_number'] ?></td>
            <td><?= $case['description'] ?></td>
            <td><?= $case['status'] ?></td>
            <td>
                <a href="edit_case.php?id=<?= $case['id'] ?>">Edit</a> | 
                <a href="delete_case.php?id=<?= $case['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>
