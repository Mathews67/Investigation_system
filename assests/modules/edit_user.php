<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Administrator') {
    redirectToLogin();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $role = $_POST['role'];

    if ($_POST['password']) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $password, $role, $userId);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $role, $userId);
    }

    if ($stmt->execute()) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "<p>Error updating user: " . $stmt->error . "</p>";
    }
}
?>
<?php include '../includes/header.php'; ?>
<h2>Edit User</h2>
<form method="POST" action="">
    <input type="text" name="username" value="<?= $user['username'] ?>" required>
    <input type="password" name="password" placeholder="Leave blank to keep current password">
    <select name="role" required>
        <option value="Administrator" <?= ($user['role'] == 'Administrator') ? 'selected' : '' ?>>Administrator</option>
        <option value="Criminal Records Officer" <?= ($user['role'] == 'Criminal Records Officer') ? 'selected' : '' ?>>Criminal Records Officer</option>
        <option value="Investigator" <?= ($user['role'] == 'Investigator') ? 'selected' : '' ?>>Investigator</option>
    </select>
    <button type="submit">Update User</button>
</form>
<?php include '../includes/footer.php'; ?>
