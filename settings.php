<?php
$host = 'feenix-mariadb.swin.edu.au';
$user = 's104656009';
$password = '160797';
$database = 's104656009_db';

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS EOI (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jobReference VARCHAR(5) NOT NULL,
    firstName VARCHAR(20) NOT NULL,
    lastName VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    address VARCHAR(50),
    suburb VARCHAR(40) NOT NULL,
    state ENUM('VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT') NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    otherSkills TEXT,
    status VARCHAR(20) DEFAULT 'New'
)";

if(!mysqli_query($conn, $sql)) {
   echo "Error creating table: " . mysqli_error($conn);
    
}

// Close the connection after operations
// mysqli_close($conn);
?>

