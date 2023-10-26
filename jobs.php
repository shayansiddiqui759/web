<!DOCTYPE html>
<html lang="en">
<?php include 'header.inc.php'; ?> <!-- Include Header -->

<body>
    <?php include 'menu.inc.php'; ?> <!-- Include Menu -->
    <div class="main-section">
        <section class="job-description">
            <h2>Position: Data Quality Manager</h2>
            <p><strong>Reference Number:</strong> DQM01</p>
            <p><strong>Salary Range:</strong> $70,000 - $100,000</p>
            <p><strong>Reporting to:</strong> Chief Data Officer</p>
            <h3>Key Responsibilities:</h3>
            <ol>
                <li>Establish and maintain data quality standards and procedures</li>
                <li>Lead a team of data quality analysts to ensure data accuracy</li>
                <li>Develop and implement data quality improvement strategies</li>
            </ol>
            <h3>Required Qualifications:</h3>
            <p><strong>Essential:</strong></p>
            <ul>
                <li>Proven experience in data quality management and data governance</li>
                <li>Strong understanding of data quality tools and techniques</li>
            </ul>
            <p><strong>Preferable:</strong></p>
            <ul>
                <li>Master's degree in Data Management or related field</li>
                <li>Experience with data quality frameworks (e.g., DQAF)</li>
            </ul>
            <a href="apply.php?jobRef=DQM01" class="apply-link" data-job-reference="DQM01">Apply</a>
        </section>

        <section class="job-description">
            <h2>Position: Junior Web Developer</h2> 
            <p><strong>Reference Number:</strong> JWD01</p>
            <p><strong>Salary Range:</strong> $50,000 - $80,000</p>
            <p><strong>Reporting to:</strong> IT Manager</p>
            <h3>Key Responsibilities:</h3>
            <ol>
                <li>Develop and maintain company websites and manage cloud</li>
                <li>Create responsive and elegant layout and designs</li>
                <li>Collaborate with designers and back-end developers</li>
            </ol>
            <h3>Required Qualifications:</h3>
            <p><strong>Essential:</strong></p>
            <ul>
                <li>Proficiency in HTML, CSS, and JavaScript with atleast 2 years of experience</li>
                <li>Experience with front-end frameworks (e.g., React, Vue)</li>
            </ul>
            <p><strong>Preferable:</strong></p>
            <ul>
                <li>Experience with back-end languages (e.g., Python, Node.js)</li>
                <li>Experience with front-end languages (e.g., React, Angular)</li>
            </ul>
            <a href="apply.php?jobRef=JWD01" class="apply-link" data-job-reference="JWD01">Apply</a>
        </section>

        <aside>
            <h4>Contact Us for any query related to jobs</h4>
            <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="number">Number:</label>
                    <input type="tel" id="number" name="number">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="desc">Description:</label>
                    <textarea id="desc" name="desc" rows="5" required></textarea>
                </div>
                <button type="submit" class="submit-button">Submit</button>
            </form>
        </aside>
    </div>
    
    <?php include 'footer.inc.php'; ?> <!-- Include Footer -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const applyLinks = document.querySelectorAll(".apply-link");

        applyLinks.forEach(link => {
        link.addEventListener("click", function(event) {
                const jobRef = this.getAttribute('data-job-reference');
                localStorage.setItem("currentJobRef", jobRef);
                });
            });
        });
    </script>
</body>
</html>