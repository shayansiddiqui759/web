<?php
include 'settings.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php"); // Assuming index.php is the main page
    exit;
}

// Sanitize input function
function sanitizeInput($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

// Data sanitization
$jobReferenceNumber = sanitizeInput($_POST['JobReferenceNumber']);
$firstName = sanitizeInput($_POST['FirstName']);
$lastName = sanitizeInput($_POST['LastName']);
$streetAddress = sanitizeInput($_POST['StreetAddress']);
$suburbTown = sanitizeInput($_POST['SuburbTown']);
$state = sanitizeInput($_POST['State']);
$postcode = sanitizeInput($_POST['Postcode']);
$email = sanitizeInput($_POST['Email']);
$phoneNumber = sanitizeInput($_POST['PhoneNumber']);
$otherSkills = sanitizeInput($_POST['OtherSkills']);

// Data validation
$errorMessages = [];

if (strlen($jobReferenceNumber) != 5 || !ctype_alnum($jobReferenceNumber)) {
    $errorMessages[] = "Job reference number must be exactly 5 alphanumeric characters.";
}

if (strlen($firstName) > 20 || !ctype_alpha($firstName)) {
    $errorMessages[] = "First name must be max 20 alpha characters.";
}

// ... continue validation for all other fields

$validStates = ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'];
if (!in_array($state, $validStates)) {
    $errorMessages[] = "Invalid state selected.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessages[] = "Invalid email format.";
}

if (strlen($phoneNumber) < 8 || strlen($phoneNumber) > 12 || !preg_match("/^[0-9 ]*$/", $phoneNumber)) {
    $errorMessages[] = "Phone number should be between 8 to 12 digits or spaces.";
}

// More validations...

if (count($errorMessages) > 0) {
    // Display the error messages to the user
    foreach ($errorMessages as $error) {
        echo $error . "<br>";
    }
    exit;
}

// If validation passed, insert into DB
$query = "INSERT INTO eoi (JobReferenceNumber, FirstName, LastName, StreetAddress, SuburbTown, State, Postcode, Email, PhoneNumber, OtherSkills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssssss", $jobReferenceNumber, $firstName, $lastName, $streetAddress, $suburbTown, $state, $postcode, $email, $phoneNumber, $otherSkills);
$stmt->execute();

// Check for successful insertion
if ($stmt->affected_rows > 0) {
    echo "Your expression of interest has been recorded. Your EOI number is: " . $conn->insert_id;
} else {
    echo "There was an error processing your request. Please try again.";
}

$stmt->close();
?>
