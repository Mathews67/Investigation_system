<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Administrator') {
    redirectToLogin();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);
    
    if ($stmt->execute()) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "<p>Error adding user: " . $stmt->error . "</p>";
    }
}
?>
<?php include '../includes/header.php'; ?>
<h2>Add User</h2>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role" required>
        <option value="Administrator">Administrator</option>
        <option value="Criminal Records Officer">Criminal Records Officer</option>
        <option value="Investigator">Investigator</option>
    </select>
    <button type="submit">Add User</button>
</form>
<?php include '../includes/footer.php'; ?>
