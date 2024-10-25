<?php
include '../includes/db.php';
include '../includes/functions.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'Administrator') {
    redirectToLogin();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $case_number = $_POST['case_number'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Prepare the SQL statement to insert a new case
    $stmt = $conn->prepare("INSERT INTO cases (case_number, description, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $case_number, $description, $status);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: manage_cases.php");
        exit();
    } else {
        echo "<p>Error adding case: " . $stmt->error . "</p>";
    }
}
?>
<?php include '../includes/header.php'; ?>
<h2>Add Case</h2>
<form method="POST" action="">
    <label for="case_number">Case Number:</label>
    <input type="text" name="case_number" required>
    
    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    
    <label for="status">Status:</label>
    <select name="status" required>
        <option value="Open">Open</option>
        <option value="Closed">Closed</option>
        <option value="In Progress">In Progress</option>
    </select>
    
    <button type="submit">Add Case</button>
</form>
<?php include '../includes/footer.php'; ?>
