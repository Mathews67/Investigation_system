<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "investigation"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create users table
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('administrator', 'criminal_records_officer', 'investigator') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_users) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table 'users': " . $conn->error . "<br>";
}

// Create crimes table
$sql_crimes = "CREATE TABLE IF NOT EXISTS crimes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    crime_type VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    severity ENUM('simple', 'misdemeanor', 'felony') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_crimes) === TRUE) {
    echo "Table 'crimes' created successfully.<br>";
} else {
    echo "Error creating table 'crimes': " . $conn->error . "<br>";
}

// Create cases table
$sql_cases = "CREATE TABLE IF NOT EXISTS cases (
    id INT PRIMARY KEY AUTO_INCREMENT,
    case_number VARCHAR(50) UNIQUE NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('open', 'in_progress', 'closed') DEFAULT 'open',
    assigned_officer_id INT,
    created_by INT NOT NULL,
    crime_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_officer_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (crime_id) REFERENCES crimes(id) ON DELETE RESTRICT
)";

if ($conn->query($sql_cases) === TRUE) {
    echo "Table 'cases' created successfully.<br>";
} else {
    echo "Error creating table 'cases': " . $conn->error . "<br>";
}

// Create case_notes table
$sql_case_notes = "CREATE TABLE IF NOT EXISTS case_notes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    case_id INT NOT NULL,
    note TEXT NOT NULL,
    officer_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE CASCADE,
    FOREIGN KEY (officer_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($conn->query($sql_case_notes) === TRUE) {
    echo "Table 'case_notes' created successfully.<br>";
} else {
    echo "Error creating table 'case_notes': " . $conn->error . "<br>";
}

// Create messages table
$sql_messages = "CREATE TABLE IF NOT EXISTS messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    content TEXT NOT NULL,
    case_id INT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE CASCADE
)";

if ($conn->query($sql_messages) === TRUE) {
    echo "Table 'messages' created successfully.<br>";
} else {
    echo "Error creating table 'messages': " . $conn->error . "<br>";
}

// Create notifications table
$sql_notifications = "CREATE TABLE IF NOT EXISTS notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    message VARCHAR(255) NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($conn->query($sql_notifications) === TRUE) {
    echo "Table 'notifications' created successfully.<br>";
} else {
    echo "Error creating table 'notifications': " . $conn->error . "<br>";
}

// Create audit_logs table
$sql_audit_logs = "CREATE TABLE IF NOT EXISTS audit_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    case_id INT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE SET NULL
)";

if ($conn->query($sql_audit_logs) === TRUE) {
    echo "Table 'audit_logs' created successfully.<br>";
} else {
    echo "Error creating table 'audit_logs': " . $conn->error . "<br>";
}

// Create role_permissions table
$sql_role_permissions = "CREATE TABLE IF NOT EXISTS role_permissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role ENUM('administrator', 'criminal_records_officer', 'investigator') NOT NULL,
    permission VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (role, permission)
)";

if ($conn->query($sql_role_permissions) === TRUE) {
    echo "Table 'role_permissions' created successfully.<br>";
} else {
    echo "Error creating table 'role_permissions': " . $conn->error . "<br>";
}

// Close connection
$conn->close();
?>
