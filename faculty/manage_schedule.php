<?php 
require_once '../includess/config.php'; 

// Restrict access
if ($_SESSION['role'] !== 'teacher') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO exam_schedule (course, semester, subject_code, subject_name, credits)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['course'],
        $_POST['semester'],
        $_POST['subject_code'],
        $_POST['subject_name'],
        $_POST['credits']
    ]);
    $success = "Schedule entry added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Exam Schedule</title>
    <!-- <link rel="stylesheet" href="../assets/css/teacherdashboard.css"> -->
    <link rel="stylesheet" href="../assets/css/schedule.css">
</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>Teacher Panel</h2>
        <ul>
            <li><a href="../faculty/dashboard.php">🏠 Dashboard</a></li>
            <li><a href="manage_schedule.php" class="active">📅 Exam Schedule</a></li>
            <li><a href="enter_marks.php">✍️ Enter Marks</a></li>
            <li class="logout"><a href="../logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="card">
            <h2>Add Exam Schedule</h2>

            <?php if(isset($success)): ?>
                <div class="success-msg"><?= $success ?></div>
            <?php endif; ?>

            <form method="POST" class="form-grid">

                <div class="form-group">
                    <label>Course</label>
                    <input type="text" name="course" placeholder="e.g. B.Tech / M.Tech" required>
                </div>

                <div class="form-group">
                    <label>Semester</label>
                    <input type="number" name="semester" required>
                </div>

                <div class="form-group">
                    <label>Subject Code</label>
                    <input type="text" name="subject_code" required>
                </div>

                <div class="form-group">
                    <label>Subject Name</label>
                    <input type="text" name="subject_name" required>
                </div>

                <div class="form-group">
                    <label>Credits</label>
                    <input type="number" name="credits" required>
                </div>

                <button type="submit" class="btn-primary">
                    Add Schedule
                </button>

            </form>
        </div>

    </main>

</div>

</body>
</html>