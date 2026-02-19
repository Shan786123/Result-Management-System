<?php 
require_once '../includess/config.php'; 

// Restrict access
if ($_SESSION['role'] !== 'teacher') {
    header("Location: ../index.php");
    exit();
}

// Handle Mark Submission
if (isset($_POST['submit_marks'])) {
    $sql = "INSERT INTO marks (student_id, subject_code, subject_name, semester, marks_obtained, credits)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['student_id'],
        $_POST['subject_code'],
        $_POST['subject_name'],
        $_POST['semester'],
        $_POST['marks_obtained'],
        $_POST['credits']
    ]);
    $msg = "Marks updated successfully!";
}

// Fetch students
$students = $pdo->query("
    SELECT u.id, u.name, s.enrollment_no 
    FROM users u 
    JOIN students s ON u.id = s.user_id 
    WHERE u.role = 'student'
")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enter Student Marks</title>
    <link rel="stylesheet" href="../assets/css/temarks.css">
    <!-- <link rel="stylesheet" href="../assets/css/marks.css"> -->
    
</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>Teacher Panel</h2>
        <ul>
            <li><a href="../faculty/dashboard.php">🏠 Dashboard</a></li>
            <li><a href="manage_schedule.php">📅 Exam Schedule</a></li>
            <li><a href="enter_marks.php" class="active">✍️ Enter Marks</a></li>
            <li class="logout"><a href="../logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="card">
            <h2>Enter Student Marks</h2>

            <?php if(isset($msg)): ?>
                <div class="success-msg"><?= $msg ?></div>
            <?php endif; ?>

            <form method="POST" class="form-grid">

                <div class="form-group">
                    <label>Student</label>
                    <select name="student_id" required>
                        <?php foreach($students as $st): ?>
                            <option value="<?= $st['id'] ?>">
                                <?= $st['name'] ?> (<?= $st['enrollment_no'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Semester</label>
                    <select name="semester" required>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Subject Name</label>
                    <input type="text" name="subject_name" required>
                </div>

                <div class="form-group">
                    <label>Subject Code</label>
                    <input type="text" name="subject_code" required>
                </div>

                <div class="form-group">
                    <label>Credits</label>
                    <input type="number" name="credits" required>
                </div>

                <div class="form-group">
                    <label>Marks Obtained</label>
                    <input type="number" name="marks_obtained" max="100" required>
                </div>

                <button type="submit" name="submit_marks" class="btn-primary">
                    Submit Marks
                </button>
            </form>
        </div>

    </main>

</div>

</body>
</html>