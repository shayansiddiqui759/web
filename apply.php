<!DOCTYPE html>
<html lang="en">

<?php 
include 'header.inc.php'; // Include Header 
$jobRef = isset($_GET['jobRef']) ? $_GET['jobRef'] : ''; 
?>

<body>
    <?php include 'menu.inc.php'; ?> <!-- Include Menu -->

    <form action="processEOI.php" method="post" id="applyForm" novalidate="novalidate">
        <h1>Job Application Form</h1>

        <label for="jobReference">Job Reference Number:</label>
        <input type="text" id="jobReference" name="jobReference" value="<?php echo htmlspecialchars($jobRef); ?>" readonly>
        <br>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" maxlength="20" required>
        <br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" maxlength="20" required>
        <br>

        <label for="dob">Date of Birth:</label>
        <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy" required>
        <br>

        <fieldset class="gender-fieldset">
            <strong>Gender:</strong>
            <div class="gender">
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">Male</label>
            </div>
            <div class="gender">
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
            </div>
            <div class="gender">
                <input type="radio" id="other" name="gender" value="other">
                <label for="other">Other</label>
            </div>
        </fieldset>
        <br>

        <label for="address">Street Address:</label>
        <input type="text" id="address" name="address" maxlength="40" required>
        <br>

        <label for="suburb">Suburb/Town:</label>
        <input type="text" id="suburb" name="suburb" maxlength="40" required>
        <br>

        <label for="state">State:</label>
        <select id="state" name="state" required>
            <option value="" disabled selected>Select a state</option>
            <option value="VIC">VIC</option>
            <option value="NSW">NSW</option>
            <option value="QLD">QLD</option>
            <option value="NT">NT</option>
            <option value="WA">WA</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="ACT">ACT</option>
        </select>
        <br>

        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode" required>
        <br>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>
        <br>

        <fieldset>
            <legend>Skills:</legend>
            <input type="checkbox" id="programming" name="skills[]" value="Programming">
            <label for="programming">Programming</label>
            <input type="checkbox" id="design" name="skills[]" value="Design">
            <label for="design">Design</label>
            <input type="checkbox" id="communication" name="skills[]" value="Communication">
            <label for="communication">Communication</label>
            <input type="checkbox" id="otherSkills" name="skills[]" value="Other skills...">
            <label for="otherSkills">Other skills...</label>
        </fieldset>
        <br>

        <label for="otherSkillsText">Other Skills (if applicable):</label>
        <textarea id="otherSkillsText" name="otherSkillsText"></textarea>
        <br>

        <button type="submit">Apply</button>
    </form>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jobReferenceInput = document.getElementById("jobReference");
            const jobRefFromStorage = localStorage.getItem("currentJobRef");

            if(jobRefFromStorage) {
                jobReferenceInput.value = jobRefFromStorage;
            }
        });
    </script>
    
    <?php include 'footer.inc.php'; ?> <!-- Include Footer -->
</body>
</html>
