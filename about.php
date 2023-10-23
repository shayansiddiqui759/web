<!DOCTYPE html>
<html lang="en">
<?php include 'header.inc.php'; ?> <!-- Include Header -->
<body>
    
    <?php include 'menu.inc.php'; ?> <!-- Include Menu -->
    
    <div class="about-container">
        <h2 class="about-title">About Me</h2>
        <div class="me">

            <figure>
                <img src="images/profile.jpeg" alt="Your Photo" class="profile-image">
            </figure>
            <dl>
                <dt>Name:</dt>
                <dd>Shayan Ahmed Siddiqui</dd>

                <dt>Student Number:</dt>
                <dd>104656008</dd>

                <dt>Tutor’s Name:</dt>
                <dd>Jeff Dunn</dd>

                <dt>Course:</dt>
                <dd>COS60004 - Creating Web Applications</dd>
            </dl>
        </div>
        <div class="table-container">
            <h3>Swinburne Timetable</h3>
            <table>
                <tr>
                    <th>Course Code</th>
                    <th>Course</th>
                    <th>Day</th>
                    <th>Time</th>
                </tr>
                <tr>
                    <td>COS60004</td>
                    <td>Creating Web Application</td>
                    <td>Friday</td>
                    <td>6:30 PM - 8:30 PM</td>
                </tr>
                <tr>
                    <td>COS6009</td>
                    <td>Data Management for the Big Data</td>
                    <td>Thursday</td>
                    <td>10:30 AM - 12:30 PM</td>
                </tr>
                <tr>
                    <td>COS60010</td>
                    <td>Technology Inquiry Project</td>
                    <td>Friday</td>
                    <td>10:30 AM - 12:30 PM</td>
                </tr>
                <tr>
                    <td>COS80025</td>
                    <td>Data Visualisation</td>
                    <td>Friday</td>
                    <td>2:30 PM - 4:30 PM</td>
                </tr>
            </table>
        </div>
        <p>Feel free to <a href="mailto:104656009@student.swin.edu.au" class="contact-link">email me</a> if you have any
            questions or would like to get in touch.</p>
    </div>
    <?php include 'footer.inc.php'; ?> <!-- Include Footer -->
    
</body>

</html>