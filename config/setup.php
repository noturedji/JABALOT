<?php
// setup.php — run ONCE, then delete this file.
require 'config.php';   // gives us $mysqli

// ---- 1. Create tables ----
$tables = [

"CREATE TABLE IF NOT EXISTS admin (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    adminmail VARCHAR(255)  NOT NULL UNIQUE,
    adminpass VARCHAR(255) NOT NULL,
    role      VARCHAR(50)  NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

"CREATE TABLE IF NOT EXISTS employees (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    fname     VARCHAR(255) NOT NULL,
    lname     VARCHAR(255) NOT NULL,
    phonenum  VARCHAR(50)  NOT NULL,
    workmail  VARCHAR(255) NOT NULL UNIQUE,
    password  VARCHAR(255) NOT NULL,
    role      VARCHAR(50)  NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

"CREATE TABLE IF NOT EXISTS attendance (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    emp_id    INT NOT NULL,
    work_date DATE,
    time_in   DATETIME,
    time_out  DATETIME,
    CONSTRAINT fk_attendance_emp
        FOREIGN KEY (emp_id) REFERENCES employees(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

];

foreach ($tables as $sql) {
    if ($mysqli->query($sql)) {
        echo "OK: table ensured.<br>";
    } else {
        die("Table error: " . $mysqli->error);
    }
}

// ---- 2. Insert default admin (only if missing) ----
$adminUser = 'admin@jaba.com';
$adminPass = password_hash('admin123', PASSWORD_DEFAULT);
$adminRole = 'superadmin';

$stmt = $mysqli->prepare(
    'INSERT INTO admin (adminmail, adminpass, role)
     VALUES (?, ?, ?)
     ON DUPLICATE KEY UPDATE adminpass = VALUES(adminpass)'
);
$stmt->bind_param('sss', $adminUser, $adminPass, $adminRole);

if ($stmt->execute()) {
    echo "Admin ready → user: <b>admin@jaba.com</b> / pass: <b>admin123</b><br>";
} else {
    echo "Admin insert failed: " . $stmt->error;
}
$stmt->close();

echo "<br>Delete setup.php now.";
$mysqli->close();