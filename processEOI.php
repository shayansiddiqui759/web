<?php
include 'settings.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit;
}

function createTableIfNotExist() {
    global $conn;
    $query = "CREATE TABLE IF NOT EXISTS EOI (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        jobReference VARCHAR(5),
        firstName VARCHAR(20),
        lastName VARCHAR(20),
        address VARCHAR(50),
        suburb VARCHAR(20),
        state VARCHAR(5),
        postcode VARCHAR(4),
        email VARCHAR(50),
        phone VARCHAR(12),
        otherSkills TEXT,
        status VARCHAR(10) DEFAULT 'New'
    )";
    if (!$conn->query($query)) {
        die("Error creating table: " . $conn->error);
    }
}

createTableIfNotExist();

function sanitizeInput($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

$jobReference = sanitizeInput($_POST['jobReference']);
$firstName = sanitizeInput($_POST['firstName']);
$lastName = sanitizeInput($_POST['lastName']);
$dob = sanitizeInput($_POST['dob']); 
$gender = sanitizeInput($_POST['gender']); 
$address = sanitizeInput($_POST['address']);
$suburb = sanitizeInput($_POST['suburb']);
$state = sanitizeInput($_POST['state']);
$postcode = sanitizeInput($_POST['postcode']);
$email = sanitizeInput($_POST['email']);
$phone = sanitizeInput($_POST['phone']);
$otherSkills = sanitizeInput($_POST['otherSkillsText']);

$errorMessages = [];


// Job reference number validation
if (strlen($jobReference) != 5 || !ctype_alnum($jobReference)) {
    $errorMessages[] = "Job reference number must be exactly 5 alphanumeric characters.";
}

// First name validation
if (strlen($firstName) > 20 || !ctype_alpha($firstName)) {
    $errorMessages[] = "First name must be max 20 alpha characters.";
}

// Last name validation
if (strlen($lastName) > 20 || !ctype_alpha($lastName)) {
    $errorMessages[] = "Last name must be max 20 alpha characters.";
}

// Parse and validate DOB
$birthDate = DateTime::createFromFormat('d/m/Y', $dob);
$now = new DateTime();
$age = $now->diff($birthDate)->y;
if (!$birthDate || $age < 15 || $age > 80) {
    $errorMessages[] = 'Invalid Date of Birth.';
} else {
    // Convert $dob to YYYY-MM-DD format for MySQL
    $mysqlFormattedDOB = $birthDate->format('Y-m-d');
}

// Gender validation
if (empty($gender) || !in_array($gender, ['male', 'female', 'other'])) {
    $errorMessages[] = 'Gender not selected or invalid.';
}

// Validate postcode based on the state
$validpostcodes = [
    'VIC' => '3\d{3}',
    'NSW' => '[12]\d{3}',
    'QLD' => '4\d{3}',
    'NT' => '0\d{3}',
    'WA' => '6\d{3}',
    'SA' => '5\d{3}',
    'TAS' => '7\d{3}',
    'ACT' => '0\d{3}'
];

if (!preg_match("/^".$validpostcodes[$state]."$/", $postcode)) {
    $errorMessages[] = "Invalid postcode for the selected state.";
}

// email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessages[] = "Invalid email format.";
}

// Phone number validation
if (strlen($phone) < 8 || strlen($phone) > 12 || !preg_match("/^[0-9 ]*$/", $phone)) {
    $errorMessages[] = "Phone number should be between 8 to 12 digits or spaces.";
}

// Check if other skills checkbox is selected but text is empty
if (isset($_POST['skills']) && in_array('Other skills...', $_POST['skills']) && empty($otherSkills)) {
    $errorMessages[] = 'Please provide details for Other skills.';
}

if (count($errorMessages) > 0) {
    foreach ($errorMessages as $error) {
        echo $error . "<br>";
    }
    exit;
}

$query = "INSERT INTO EOI (jobReference, firstName, lastName, address, suburb, state, postcode, email, phone, otherSkills, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("ssssssssss", $jobReference, $firstName, $lastName, $address, $suburb, $state, $postcode, $email, $phone, $otherSkills);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Your expression of interest has been recorded. Your EOI number is: " . $conn->insert_id;
} else {
    echo "There was an error processing your request. Please try again.";
}

$stmt->close();
?>
