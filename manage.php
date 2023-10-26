<?php
include 'settings.php';

// Function to list all EOIs
function listAllEOIs($conn) {
    $query = "SELECT * FROM EOI";
    $result = $conn->query($query);
    return $result;
}

// Function to list EOIs for a particular position
function listEOIsByPosition($conn, $jobReference) {
    $query = "SELECT * FROM EOI WHERE jobReference = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $jobReference);
    $stmt->execute();
    return $stmt->get_result();
}

// Function to list EOIs for a particular applicant
function listEOIsByApplicant($conn, $firstName, $lastName) {
    $query = "SELECT * FROM EOI WHERE firstName = ? OR lastName = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $firstName, $lastName);
    $stmt->execute();
    return $stmt->get_result();
}

// Function to update the status of an EOI
function updateEOIStatus($conn, $eoiId, $newStatus) {
    $query = "UPDATE EOI SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $newStatus, $eoiId);
    $stmt->execute();
}

// Function to delete EOIs with a specified job reference number
function deleteEOIsByJobRef($conn, $jobReference) {
    $query = "DELETE FROM EOI WHERE jobReference = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $jobReference);
    $stmt->execute();
}

// Initialize the variable for search results
$searchResults = null;

// Handling form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_status'])) {
        // Update EOI status
        updateEOIStatus($conn, $_POST['eoi_id'], $_POST['new_status']);
    } elseif (isset($_POST['delete_eoi'])) {
        // Delete EOIs
        deleteEOIsByJobRef($conn, $_POST['job_ref_to_delete']);
    } elseif (isset($_POST['search_applicant'])) {
        // Search EOIs by Applicant Name
        $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $searchResults = listEOIsByApplicant($conn, $firstName, $lastName);
    }
}

// Default to fetching all EOIs if no specific search is made
if (!$searchResults) {
    $searchResults = listAllEOIs($conn);
}

?>

<!DOCTYPE html>
<html>
<?php include 'header.inc.php'; ?> <!-- Include Header -->

<body>
    <?php include 'menu.inc.php'; ?> <!-- Include Menu -->
    <div class="main-section">
        <!-- Displaying EOIs -->
        <section class="job-description">
            <h2>EOI Results</h2>
                <table>
                <tr>
                    <th>Job Reference</th>
                    <th>EOI_ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Status</th>
                </tr>
                <?php
                while ($row = $searchResults->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['jobReference'] . "</td>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['lastName'] . "</td>";
                    echo "<td>" . $row['firstName'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";            
                    echo "</tr>";
                }
                ?>
            </table>
            <form method="post">
                <input type="submit" name="list_all" value="List All EOIs">
            </form>
        </section>
        <aside>

            <!-- Search by Applicant Form -->
            <form method="post" class="search-form">
                <h2>Search EOIs by Applicant</h2>
                <input type="text" name="first_name" placeholder="First Name">
                <input type="text" name="last_name" placeholder="Last Name">
                <input type="submit" name="search_applicant" value="Search">
            </form>
            <!-- Update Status Form -->
            <form method="post">
                <h2>Update EOI Status</h2>
                <input type="number" name="eoi_id" placeholder="EOI ID">
                <select name="new_status">
                    <option value="New">New</option>
                    <option value="Processing">Processing</option>
                    <option value="Closed">Closed</option>
                </select>
                <input type="submit" name="update_status" value="Update Status">
            </form>
        
            <!-- Delete EOI Form -->
            <form method="post">
                <h2>Delete EOIs</h2>
                <input type="text" name="job_ref_to_delete" placeholder="Job Reference Number">
                <input type="submit" name="delete_eoi" value="Delete EOIs">
            </form>

        </aside>
    </div>
    <?php include 'footer.inc.php'; ?> <!-- Include Footer -->
</body>
</html>
