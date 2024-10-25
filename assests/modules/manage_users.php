<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Administrator') {
    redirectToLogin();
}

// Fetch users for management
$users = $conn->query("SELECT * FROM users");
?>
<?php include '../includes/header.php'; ?>
<h2>Manage Users</h2>
<a href="add_user.php" class="button">Add User</a>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    <?php while ($user = $users->fetch_assoc()) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['role'] ?></td>
            <td>
                <a href="edit_user.php?id=<?= $user['id'] ?>">Edit</a> | 
                <a href="delete_user.php?id=<?= $user['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>
