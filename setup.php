<?php
include 'settings.php';

$query = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    JobReferenceNumber VARCHAR(5),
    FirstName VARCHAR(20),
    LastName VARCHAR(20),
    StreetAddress VARCHAR(40),
    SuburbTown VARCHAR(40),
    State ENUM('VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'),
    Postcode VARCHAR(4),
    Email VARCHAR(50),
    PhoneNumber VARCHAR(12),
    Skill1 VARCHAR(30),
    Skill2 VARCHAR(30),
    //... add other skill columns as required
    OtherSkills TEXT,
    Status ENUM('New', 'Current', 'Final') DEFAULT 'New'
)";
mysqli_query($conn, $query);
?>
