<?php 
require_once '../includess/config.php'; 
// Ensure only students can access
if ($_SESSION['role'] !== 'student') { 
    header("Location: ../index.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fill Examination Form | Student</title>
    <link rel="stylesheet" href="studash.css">
    <link rel="stylesheet" href="image.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="user-profile">
            <img src="../assets/img/<?php echo $_SESSION['profile_pic']; ?>" alt="Profile">
        </div>
        <h2>Student Panel</h2>
        <ul>
            <li><a href="../student/dashboard.php">🏠 Dashboard</a></li>
            <li><a href="view_profile.php">👤 My Profile</a></li>
            <li><a href="fill_form.php" class="active">📝 Exam Form</a></li>
            <li><a href="view_results.php">📄 View Marksheet</a></li>
            <li class="logout"><a href="../logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content">

        <div class="form-card">
            <h2>Fill Examination Form</h2>

            <form action="process_exam_form.php" method="POST">

                <div class="form-group">
                    <label>Select Semester</label>
                    <select name="semester" id="semester" required onchange="fetchSubjects(this.value)">
                        <option value="">Choose Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                    </select>
                </div>

                <div id="subject_selection" class="subject-box">
                    <!-- Subjects loaded via AJAX -->
                </div>

                <button type="submit" class="btn-primary">Submit Form</button>
            </form>
        </div>

    </main>

</div>

<script>
function fetchSubjects(sem) {
    if(sem !== "") {
        $.ajax({
            url: '../ajax/get_semester_subject.php',
            type: 'POST',
            data: { semester: sem },
            success: function(data) {
                $('#subject_selection').html(data);
            }
        });
    }
}
</script>

</body>
</html>