<?php 
require_once '../includess/config.php'; 
if ($_SESSION['role'] !== 'teacher') { 
    header("Location: ../index.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>

    <!-- Teacher specific sidebar CSS -->
    <link rel="stylesheet" href="../assets/css/teacherdashboard.css">
</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>Teacher Panel</h2>
        <ul>
            <li><a href="../faculty/dashboard.php" class="active">🏠 Dashboard</a></li>
            <li><a href="manage_schedule.php">📅 Exam Schedule</a></li>
            <li><a href="enter_marks.php">✍️ Enter Marks</a></li>
            <li class="logout"><a href="../logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content">

        <div class="card">
            <h2>Welcome, <?= htmlspecialchars($_SESSION['name']); ?> 👋</h2>
            <p>Use the sidebar to manage exams and student marks.</p>

            <div class="card-grid">
                <a href="manage_schedule.php" class="dashboard-card">
                    <h3>📅 Exam Schedule</h3>
                    <p>Create and manage examination schedules</p>
                </a>

                <a href="enter_marks.php" class="dashboard-card">
                    <h3>✍️ Enter Marks</h3>
                    <p>Upload and update student marks</p>
                </a>
            </div>
        </div>

    </main>

</div>

</body>
</html>