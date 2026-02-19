<?php
require_once '../includess/config.php';
$uid = $_SESSION['user_id'];

$stmt = $pdo->prepare(
    "SELECT users.name, students.* 
     FROM users 
     JOIN students ON users.id = students.user_id 
     WHERE users.id = ?"
);
$stmt->execute([$uid]);
$student = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile | Student</title>
    <link rel="stylesheet" href="studash.css">
    <link rel="stylesheet" href="image.css">
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
            <li><a href="view_profile.php" class="active">👤 My Profile</a></li>
            <li><a href="fill_form.php">📝 Exam Form</a></li>
            <li><a href="view_results.php">📄 View Marksheet</a></li>
            <li class="logout"><a href="../logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="profile-card">
            <div class="user-profile">
                <img src="../assets/img/<?php echo $_SESSION['profile_pic']; ?>" alt="Profile">
            </div>
            <h3>My Profile</h3>

            <div class="profile-row">
                <span>Name</span>
                <span><?= htmlspecialchars($student['name']) ?></span>
            </div>

            <div class="profile-row">
                <span>Enrollment No</span>
                <span><?= htmlspecialchars($student['enrollment_no']) ?></span>
            </div>

            <div class="profile-row">
                <span>Course</span>
                <span><?= htmlspecialchars($student['course']) ?></span>
            </div>
        </div>

    </main>

</div>

</body>
</html>